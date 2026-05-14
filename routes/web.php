<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Password;
use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Events\Verified;
use Illuminate\Support\Facades\DB;
use App\Models\Applicant;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ManagerController;
use App\Http\Controllers\ApplicantController;

// 1. Halaman Beranda (Landing Page)
Route::get('/', function () {
    return view('welcome');
})->name('welcome');

// 2. Halaman Dashboard Mahasiswa (Bypass Login untuk FE)
Route::get('/dashboard', [ApplicantController::class, 'dashboard'])->name('dashboard');
Route::get('/applicant/status', [ApplicantController::class, 'status'])->name('applicant.status');

// ===== Routes untuk Applicant =====
Route::get('/applicant/profile', [ApplicantController::class, 'profile'])->name('applicant.profile');
Route::post('/applicant/profile', [ApplicantController::class, 'updateProfile'])->name('applicant.profile.update');

Route::get('/applicant/program', [ApplicantController::class, 'program'])->name('applicant.program');
Route::post('/applicant/program', [ApplicantController::class, 'saveProgram'])->name('applicant.program.save');

Route::get('/applicant/documents', [ApplicantController::class, 'documents'])->name('applicant.documents');
Route::post('/applicant/applications/{application}/documents', [ApplicantController::class, 'uploadDocument'])->name('applicant.documents.upload');

Route::get('/applicant/outcomes', [ApplicantController::class, 'outcomes'])->name('applicant.outcomes');
Route::post('/applicant/applications/{application}/experiences', [ApplicantController::class, 'storeExperience'])->name('applicant.experiences.store');
Route::patch('/applicant/applications/{application}/submit', [ApplicantController::class, 'submit'])->name('applicant.applications.submit');
Route::patch('/applicant/applications/{application}/cancel', [ApplicantController::class, 'cancel'])->name('applicant.applications.cancel');

// 3. Halaman Informasi Publik
Route::get('/tentang-rpl', function () {
    return view('pages.about');
})->name('about');

Route::get('/persyaratan', function () {
    return view('pages.requirements');
})->name('requirements');

Route::get('/faq', function () {
    return view('pages.faq');
})->name('faq');

Route::get('/pengumuman', function () {
    return view('pages.announcements');
})->name('announcements');

// 4. Routes Asesor
Route::get('/dashboard-asesor', function () {
    return view('assessor.dashboard');
})->name('dashboard.assessor');

Route::get('/asesor/antrean', function () {
    return view('assessor.queue');
})->name('assessor.queue');

Route::get('/asesor/riwayat', function () {
    return view('assessor.history');
})->name('assessor.history');

// ===== Routes Manajer/Pengelola =====
Route::get('/dashboard-manager', [ManagerController::class, 'dashboard'])->name('dashboard.manager');

Route::get('/manager/pengajuan', [ManagerController::class, 'applications'])->name('manager.applications');

Route::get('/manager/assign', [ManagerController::class, 'assignment'])->name('manager.assignment');
Route::post('/manager/applications/{application}/assign', [ManagerController::class, 'assign'])->name('manager.applications.assign');

Route::get('/manager/asesor', [ManagerController::class, 'asesors'])->name('manager.asesors');

Route::get('/manager/laporan', [ManagerController::class, 'reports'])->name('manager.reports');

// ===== AUTH ROUTES =====

// --- LOGIN ---
Route::get('/login', function () {
    return view('auth.login');
})->name('login');

Route::post('/login', function (Request $request) {
    $request->validate([
        'identifier' => 'required_without:email|string|nullable',
        'email'      => 'required_without:identifier|email|nullable',
        'password'   => 'required|string',
    ]);

    $identifier = $request->input('identifier', $request->input('email'));

    // Cari user berdasarkan email atau NIK
    $user = User::where('email', $identifier)
        ->orWhereHas('applicant', fn($q) => $q->where('nik', $identifier))
        ->first();

    if (!$user || !Hash::check($request->password, $user->password)) {
        return back()
            ->withInput($request->only('identifier', 'remember'))
            ->withErrors(['identifier' => 'Email, NIK, atau kata sandi salah.']);
    }

    // Cek akun aktif
    if (!$user->is_active) {
        return back()
            ->withInput($request->only('identifier', 'remember'))
            ->withErrors(['identifier' => 'Akun Anda tidak aktif. Hubungi administrator.']);
    }

    Auth::login($user, $request->boolean('remember'));
    $request->session()->regenerate();

    // Redirect berdasarkan role
    return match ($user->role) {
        'asesor', 'assessor' => redirect('/dashboard-asesor'),
        'manager'  => redirect('/dashboard-manager'),
        default    => redirect('/dashboard'),
    };
})->name('login.post');

// --- REGISTER ---
Route::get('/register', function () {
    return view('auth.register');
})->name('register');

Route::post('/register', function (Request $request) {
    $request->validate([
        'name'     => 'required|string|max:255',
        'email'    => 'required|email|unique:users,email',
        'password' => 'required|min:6|confirmed',
        'nik'      => 'nullable|string|size:16|unique:applicants,nik',
        'no_hp'    => 'nullable|string|max:20',
        'alamat'   => 'nullable|string',
    ]);

    $user = DB::transaction(function () use ($request) {
        $user = User::create([
            'name'     => $request->name,
            'email'    => $request->email,
            'password' => Hash::make($request->password),
            'role'     => 'applicant',
            'is_active'=> true,
        ]);

        Applicant::create([
            'user_id' => $user->id,
            'nama'    => $request->name,
            'nik'     => $request->nik,
            'no_hp'   => $request->no_hp,
            'alamat'  => $request->alamat,
        ]);

        return $user;
    });

    try {
        event(new Registered($user));
    } catch (\Throwable $e) {
        report($e);
    }

    // Langsung login setelah register
    Auth::login($user);
    $request->session()->regenerate();

    return redirect('/dashboard')
        ->with('success', 'Akun berhasil dibuat! Silakan verifikasi email Anda.');
})->name('register.post');

// --- FORGOT PASSWORD ---
Route::get('/forgot-password', function () {
    return view('auth.forgot-password');
})->middleware('guest')->name('password.request');

Route::post('/forgot-password', function (Request $request) {
    $request->validate([
        'email' => 'required|email',
    ]);

    $status = Password::sendResetLink($request->only('email'));

    return $status === Password::RESET_LINK_SENT
        ? back()->with('status', __($status))
        : back()->withErrors(['email' => __($status)]);
})->middleware('guest')->name('password.email');

Route::get('/password/request', function () {
    return redirect()->route('password.request');
});

Route::post('/password/email', function (Request $request) {
    $request->validate([
        'email' => 'required|email',
    ]);

    $status = Password::sendResetLink($request->only('email'));

    return $status === Password::RESET_LINK_SENT
        ? back()->with('status', __($status))
        : back()->withErrors(['email' => __($status)]);
});

Route::get('/reset-password/{token}', function (string $token) {
    return view('auth.reset-password', ['token' => $token]);
})->middleware('guest')->name('password.reset');

Route::post('/reset-password', function (Request $request) {
    $request->validate([
        'token' => 'required',
        'email' => 'required|email',
        'password' => 'required|min:6|confirmed',
    ]);

    $status = Password::reset(
        $request->only('email', 'password', 'password_confirmation', 'token'),
        function (User $user, string $password) {
            $user->forceFill([
                'password' => Hash::make($password),
            ])->save();
        }
    );

    return $status === Password::PASSWORD_RESET
        ? redirect()->route('login')->with('status', __($status))
        : back()->withInput($request->only('email'))->withErrors(['email' => __($status)]);
})->middleware('guest')->name('password.store');

Route::get('/verify-email', function () {
    return view('auth.verify-email');
})->middleware('auth')->name('verification.notice');

Route::get('/email/verify/{id}/{hash}', function (Request $request, string $id, string $hash) {
    $user = User::findOrFail($id);

    abort_unless(hash_equals($hash, sha1($user->getEmailForVerification())), 403);

    if (!$user->hasVerifiedEmail()) {
        $user->markEmailAsVerified();
        event(new Verified($user));
    }

    return redirect('/dashboard?verified=1');
})->middleware(['auth', 'signed'])->name('verification.verify');

Route::post('/email/verification-notification', function (Request $request) {
    if ($request->user()->hasVerifiedEmail()) {
        return redirect('/dashboard');
    }

    $request->user()->sendEmailVerificationNotification();

    return back()->with('status', 'verification-link-sent');
})->middleware(['auth', 'throttle:6,1'])->name('verification.send');

Route::get('/confirm-password', function () {
    return view('auth.confirm-password');
})->middleware('auth')->name('password.confirm');

Route::post('/confirm-password', function (Request $request) {
    $request->validate([
        'password' => 'required|current_password',
    ]);

    $request->session()->put('auth.password_confirmed_at', time());

    return redirect()->intended('/dashboard');
})->middleware('auth')->name('password.confirm.store');

Route::put('/password', function (Request $request) {
    $request->validateWithBag('updatePassword', [
        'current_password' => ['required', 'current_password'],
        'password' => ['required', 'confirmed', 'min:6'],
    ]);

    $request->user()->update([
        'password' => Hash::make($request->password),
    ]);

    return back()->with('status', 'password-updated');
})->middleware('auth')->name('password.update');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// --- LOGOUT ---
Route::post('/logout', function (Request $request) {
    Auth::logout();
    $request->session()->invalidate();
    $request->session()->regenerateToken();

    return redirect('/');
})->name('logout');

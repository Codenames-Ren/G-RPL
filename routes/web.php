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

//PUBLIC PAGES
Route::get('/', function () {
    return view('welcome');
})->name('welcome');

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


/*
AUTH ROUTES
*/

// LOGIN PAGE
Route::get('/login', function () {
    return view('auth.login');
})->middleware('guest')->name('login');

// LOGIN PROCESS
Route::post('/login', function (Request $request) {

    $request->validate([
        'identifier' => 'required_without:email|string|nullable',
        'email'      => 'required_without:identifier|email|nullable',
        'password'   => 'required|string',
    ]);

    $identifier = $request->input(
        'identifier',
        $request->input('email')
    );

    // Find user by email or NIK
    $user = User::where('email', $identifier)
        ->orWhereHas('applicant', function ($query) use ($identifier) {
            $query->where('nik', $identifier);
        })
        ->first();

    // Invalid credentials
    if (
        !$user ||
        !Hash::check($request->password, $user->password)
    ) {
        return back()
            ->withInput(
                $request->only('identifier', 'remember')
            )
            ->withErrors([
                'identifier' =>
                    'Email, NIK, atau kata sandi salah.'
            ]);
    }

    // Inactive account
    if (!$user->is_active) {
        return back()
            ->withInput(
                $request->only('identifier', 'remember')
            )
            ->withErrors([
                'identifier' =>
                    'Akun Anda tidak aktif.'
            ]);
    }

    // Email not verified
    if (!$user->hasVerifiedEmail()) {

        return back()
            ->withInput(
                $request->only('identifier')
            )
            ->with(
                'warning',
                'Email Anda belum terverifikasi. Silakan cek email Anda.'
            );
    }

    Auth::login(
        $user,
        $request->boolean('remember')
    );

    $request->session()->regenerate();

    return match ($user->role) {

        'asesor', 'assessor'
            => redirect('/dashboard-asesor')
                ->with('success', 'Login berhasil.'),

        'manager'
            => redirect('/dashboard-manager')
                ->with('success', 'Login berhasil.'),
        
        'superadmin'
            => redirect('/dashboard-superadmin')
                ->with('success', 'Login berhasil.'),

        default
            => redirect('/dashboard')
                ->with('success', 'Login berhasil.'),
    };

})->middleware('throttle:5,1')
  ->name('login.post');


// REGISTER PAGE
Route::get('/register', function () {
    return view('auth.register');
})->middleware('guest')->name('register');


// REGISTER PROCESS
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
            'name'      => $request->name,
            'email'     => $request->email,
            'password'  => Hash::make($request->password),
            'role'      => 'applicant',
            'is_active' => true,
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

    // DO NOT AUTO LOGIN
    return redirect('/login')
        ->with(
            'success',
            'Registrasi berhasil. Silakan cek email anda untuk melakukan verifikasi.'
        );

})->middleware('throttle:3,1')
  ->name('register.post');


// VERIFY EMAIL PAGE
Route::get('/verify-email', function () {
    return view('auth.verify-email');
})->middleware('auth')
  ->name('verification.notice');


// VERIFY EMAIL PROCESS
Route::get('/email/verify/{id}/{hash}', function (
    Request $request,
    string $id,
    string $hash
) {

    $user = User::findOrFail($id);

    abort_unless(
        hash_equals(
            $hash,
            sha1($user->getEmailForVerification())
        ),
        403
    );

    if (!$user->hasVerifiedEmail()) {

        $user->markEmailAsVerified();

        event(new Verified($user));
    }

    return redirect('/login')
        ->with(
            'success',
            'Email berhasil diverifikasi.'
        );

})->middleware(['signed'])
  ->name('verification.verify');


// RESEND VERIFICATION EMAIL
Route::post('/email/verification-notification', function (
    Request $request
) {

    if ($request->user()->hasVerifiedEmail()) {
        return redirect('/dashboard');
    }

    $request->user()
        ->sendEmailVerificationNotification();

    return back()
        ->with(
            'status',
            'verification-link-sent'
        );

})->middleware([
    'auth',
    'throttle:6,1'
])->name('verification.send');

// FORGOT PASSWORD
Route::get('/forgot-password', function () {
    return view('auth.forgot-password');
})->middleware('guest')
  ->name('password.request');

// LOGOUT
Route::post('/logout', function (Request $request) {

    Auth::logout();

    $request->session()->invalidate();

    $request->session()->regenerateToken();

    return redirect('/login')
        ->with(
            'success',
            'Logout berhasil.'
        );

})->middleware('auth')
  ->name('logout');

// ROLE-AWARE DASHBOARD ENTRY
Route::get('/dashboard', function (Request $request) {
    return match ($request->user()->role) {
        'asesor', 'assessor'
            => redirect()->route('dashboard.assessor'),

        'manager'
            => redirect()->route('dashboard.manager'),

        'superadmin'
            => redirect()->route('dashboard.superadmin'),

        default
            => view('applicant.dashboard'),
    };
})->middleware([
    'auth',
    'verified',
])->name('dashboard');

//APPLICANT ROUTES

Route::middleware([
    'auth',
    'verified',
    'role:applicant'
])->group(function () {

    Route::get('/applicant/status', function () {
        return view('applicant.status');
    })->name('applicant.status');

    Route::get('/applicant/profile', function () {
        return view('applicant.profile');
    })->name('applicant.profile');

    Route::get('/applicant/program', function () {
        return view('applicant.program');
    })->name('applicant.program');

    Route::get('/applicant/documents', function () {
        return view('applicant.documents');
    })->name('applicant.documents');

    Route::get('/applicant/outcomes', function () {
        return view('applicant.outcomes');
    })->name('applicant.outcomes');
});

//ASESOR ROUTES

Route::middleware([
    'auth',
    'verified',
    'role:asesor'
])->group(function () {

    Route::get('/dashboard-asesor', function () {
        return view('assessor.dashboard');
    })->name('dashboard.assessor');

    Route::get('/asesor/antrean', function () {
        return view('assessor.queue');
    })->name('assessor.queue');

    Route::get('/asesor/riwayat', function () {
        return view('assessor.history');
    })->name('assessor.history');
});

//MANAGER ROUTES

Route::middleware([
    'auth',
    'verified',
    'role:manager'
])->group(function () {

    Route::get('/dashboard-manager', function () {
        return view('manager.dashboard');
    })->name('dashboard.manager');

    Route::get('/manager/pengajuan', function () {
        return view('manager.applications');
    })->name('manager.applications');

    Route::get('/manager/assign', function () {
        return view('manager.assignment');
    })->name('manager.assignment');

    Route::get('/manager/asesor', function () {
        return view('manager.asesors');
    })->name('manager.asesors');

    Route::get('/manager/laporan', function () {
        return view('manager.reports');
    })->name('manager.reports');
});

//SUPERADMIN ROUTES

Route::middleware([
    'auth',
    'verified',
    'role:superadmin'
])->group(function () {

    Route::get('/dashboard-superadmin', function () {
        return view('superadmin.dashboard');
    })->name('dashboard.superadmin');

    Route::get('/superadmin/staff', function () {
        return view('superadmin.staff');
    })->name('superadmin.staff');

    Route::get('/superadmin/managers', function () {
        return view('superadmin.managers');
    })->name('superadmin.managers');

    Route::get('/superadmin/asesors', function () {
        return view('superadmin.asesors');
    })->name('superadmin.asesors');

});

//PROFILE ROUTES
Route::middleware('auth')->group(function () {

    Route::get('/profile', [
        ProfileController::class,
        'edit'
    ])->name('profile.edit');

    Route::patch('/profile', [
        ProfileController::class,
        'update'
    ])->name('profile.update');

    Route::delete('/profile', [
        ProfileController::class,
        'destroy'
    ])->name('profile.destroy');
});

<?php

namespace App\Http\Controllers;

use App\Models\Application;
use App\Models\ApplicationDocument;
use App\Models\Konsentrasi;
use App\Models\LearningExperience;
use App\Models\Prodi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ApplicantController extends Controller
{
    public function dashboard()
    {
        $applicant = $this->applicant();
        $applications = $this->applicationsQuery()->get();
        $currentApplication = $applications->first();

        return view('applicant.dashboard', [
            'applicant' => $applicant,
            'applications' => $applications,
            'application' => $currentApplication,
            'progress' => $this->progressFor($currentApplication),
        ]);
    }

    public function status()
    {
        $applications = $this->applicationsQuery()->get();
        $currentApplication = $applications->first();

        return view('applicant.status', [
            'application' => $currentApplication,
            'applications' => $applications,
            'progress' => $this->progressFor($currentApplication),
        ]);
    }

    public function profile()
    {
        return view('applicant.profile', [
            'user' => Auth::user(),
            'applicant' => $this->applicant(),
            'application' => $this->currentEditableApplication(),
        ]);
    }

    public function updateProfile(Request $request)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255', 'unique:users,email,'.Auth::id()],
            'nik' => ['nullable', 'string', 'size:16', 'unique:applicants,nik,'.$this->applicant()?->id],
            'no_hp' => ['nullable', 'string', 'max:20'],
            'alamat' => ['nullable', 'string'],
        ]);

        DB::transaction(function () use ($validated) {
            Auth::user()->update([
                'name' => $validated['name'],
                'email' => $validated['email'],
            ]);

            $this->applicant()->update([
                'nama' => $validated['name'],
                'nik' => $validated['nik'] ?? null,
                'no_hp' => $validated['no_hp'] ?? null,
                'alamat' => $validated['alamat'] ?? null,
            ]);
        });

        return redirect()->route('applicant.program')->with('success', 'Profil berhasil disimpan.');
    }

    public function program()
    {
        $application = $this->currentEditableApplication();

        return view('applicant.program', [
            'application' => $application,
            'prodis' => Prodi::with('konsentrasis')->orderBy('nama_prodi')->get(),
            'konsentrasis' => Konsentrasi::orderBy('nama_konsentrasi')->get(),
        ]);
    }

    public function saveProgram(Request $request)
    {
        $validated = $request->validate([
            'jenis_rpl' => ['required', 'in:A,B'],
            'prodi_id' => ['required', 'exists:prodis,id'],
            'konsentrasi_id' => ['nullable', 'exists:konsentrasis,id'],
        ]);

        $application = $this->currentEditableApplication();
        $payload = [
            'applicant_id' => $this->applicant()->id,
            'jenis_rpl' => $validated['jenis_rpl'],
            'prodi_id' => $validated['prodi_id'],
            'konsentrasi_id' => $validated['konsentrasi_id'] ?? null,
            'status' => $application?->status ?? 'draft',
        ];

        if ($application) {
            $application->update($payload);
        } else {
            $application = Application::create($payload);
        }

        return redirect()->route('applicant.documents')->with('success', 'Program berhasil disimpan.');
    }

    public function documents()
    {
        $application = $this->currentEditableApplication() ?: $this->applicationsQuery()->first();

        return view('applicant.documents', [
            'application' => $application,
            'documents' => $application?->documents()->latest()->get() ?? collect(),
            'documentTypes' => $this->documentTypes(),
        ]);
    }

    public function uploadDocument(Request $request, Application $application)
    {
        $this->authorizeApplication($application);

        if (! in_array($application->status, ['draft', 'rejected'], true)) {
            return back()->withErrors(['file' => 'Document upload not allowed for this application status.']);
        }

        $validated = $request->validate([
            'type' => ['required', 'string', 'max:100'],
            'file' => ['required', 'file', 'mimes:pdf,jpg,jpeg,png', 'max:3072'],
        ]);

        $path = $request->file('file')->store('documents', 'public');

        ApplicationDocument::create([
            'application_id' => $application->id,
            'type' => $validated['type'],
            'file_path' => $path,
        ]);

        return redirect()->route('applicant.documents')->with('success', 'Dokumen berhasil diupload.');
    }

    public function outcomes()
    {
        $application = $this->currentEditableApplication() ?: $this->applicationsQuery()->first();

        return view('applicant.outcomes', [
            'application' => $application,
            'experiences' => $application?->learningExperiences()->latest()->get() ?? collect(),
            'documentsCount' => $application?->documents()->count() ?? 0,
        ]);
    }

    public function storeExperience(Request $request, Application $application)
    {
        $this->authorizeApplication($application);

        if (! in_array($application->status, ['draft', 'rejected'], true)) {
            return back()->withErrors(['title' => 'Learning experience cannot be added for this application status.']);
        }

        $validated = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'type' => ['required', 'in:course,experience'],
            'description' => ['nullable', 'string'],
        ]);

        LearningExperience::create([
            'application_id' => $application->id,
            'title' => $validated['title'],
            'type' => $validated['type'],
            'description' => $validated['description'] ?? null,
        ]);

        return redirect()->route('applicant.outcomes')->with('success', 'Learning experience berhasil ditambahkan.');
    }

    public function submit(Application $application)
    {
        $this->authorizeApplication($application);

        if (! in_array($application->status, ['draft', 'rejected'], true)) {
            return back()->withErrors(['submit' => 'Application already submitted.']);
        }

        if ($application->documents()->count() < 1) {
            return back()->withErrors(['submit' => 'Document is required.']);
        }

        if ($application->learningExperiences()->count() < 1) {
            return back()->withErrors(['submit' => 'Learning experiences must be filled.']);
        }

        $application->update(['status' => 'submitted']);

        return redirect()->route('dashboard')->with('success', 'Application submitted successfully.');
    }

    public function cancel(Application $application)
    {
        $this->authorizeApplication($application);

        if (! in_array($application->status, ['draft', 'submitted'], true)) {
            return back()->withErrors(['submit' => 'Application cannot be cancelled.']);
        }

        $application->update(['status' => 'cancelled']);

        return redirect()->route('dashboard')->with('success', 'Application cancelled successfully.');
    }

    private function applicant()
    {
        return Auth::user()?->applicant;
    }

    private function applicationsQuery()
    {
        return Application::with(['prodi', 'konsentrasi', 'documents', 'learningExperiences', 'latestAssignment.asesor'])
            ->where('applicant_id', $this->applicant()?->id)
            ->latest();
    }

    private function currentEditableApplication(): ?Application
    {
        return $this->applicationsQuery()
            ->whereIn('status', ['draft', 'rejected'])
            ->first();
    }

    private function authorizeApplication(Application $application): void
    {
        abort_unless($application->applicant_id === $this->applicant()?->id, 403);
    }

    private function progressFor(?Application $application): array
    {
        return [
            'profile' => (bool) ($this->applicant()?->nik && $this->applicant()?->no_hp),
            'program' => (bool) $application,
            'documents' => (bool) ($application?->documents->count() > 0),
            'experiences' => (bool) ($application?->learningExperiences->count() > 0),
        ];
    }

    private function documentTypes(): array
    {
        return [
            'ktp' => 'KTP (Scan Asli)',
            'ijazah' => 'Ijazah Terakhir',
            'transkrip' => 'Transkrip Nilai',
            'cv' => 'CV / Curriculum Vitae',
            'surat_kerja' => 'Surat Keterangan Kerja',
            'sertifikat' => 'Sertifikat Pendukung',
        ];
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Application;
use App\Models\Assignment;
use App\Models\Asesor;
use App\Models\RplManager;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ManagerController extends Controller
{
    private const MANAGER_STATUSES = ['submitted', 'assigned', 'assessed', 'approved', 'rejected'];

    public function dashboard()
    {
        $applications = $this->managerApplicationsQuery()->get();
        $activeAsesors = Asesor::with('prodis')->withCount('assignments')->latest()->take(3)->get();

        return view('manager.dashboard', [
            'stats' => $this->buildStats($applications),
            'latestApplications' => $applications->take(5),
            'activeAsesors' => $activeAsesors,
        ]);
    }

    public function applications()
    {
        $applications = $this->managerApplicationsQuery()->get();

        return view('manager.applications', [
            'applications' => $applications,
            'statusOptions' => $applications->pluck('status')->unique()->sort()->values(),
            'prodiOptions' => $applications->pluck('prodi.nama_prodi')->filter()->unique()->sort()->values(),
        ]);
    }

    public function assignment()
    {
        $applications = $this->managerApplicationsQuery()
            ->where('status', 'submitted')
            ->doesntHave('latestAssignment')
            ->get();

        $asesors = Asesor::with(['prodis', 'user'])
            ->withCount('assignments')
            ->latest()
            ->get();

        return view('manager.assignment', [
            'applications' => $applications,
            'asesors' => $asesors,
        ]);
    }

    public function asesors()
    {
        $asesors = Asesor::with(['prodis', 'user'])
            ->withCount([
                'assignments',
                'assignments as completed_assignments_count' => function ($query) {
                    $query->whereHas('application', function ($applicationQuery) {
                        $applicationQuery->whereIn('status', ['assessed', 'approved', 'rejected']);
                    });
                },
            ])
            ->latest()
            ->get();

        return view('manager.asesors', ['asesors' => $asesors]);
    }

    public function reports()
    {
        $applications = $this->managerApplicationsQuery()->get();
        $total = max($applications->count(), 1);
        $statusData = collect(['submitted', 'assigned', 'assessed', 'approved', 'rejected'])
            ->map(function ($status) use ($applications, $total) {
                $count = $applications->where('status', $status)->count();

                return [
                    'label' => str($status)->title()->toString(),
                    'count' => $count,
                    'percentage' => round(($count / $total) * 100),
                    'color' => $this->statusBarColor($status),
                ];
            });

        $reportRows = Asesor::withCount([
            'assignments',
            'assignments as total_dinilai' => function ($query) {
                $query->whereHas('application', fn ($q) => $q->whereIn('status', ['assessed', 'approved', 'rejected']));
            },
            'assignments as approved_count' => function ($query) {
                $query->whereHas('application', fn ($q) => $q->where('status', 'approved'));
            },
            'assignments as rejected_count' => function ($query) {
                $query->whereHas('application', fn ($q) => $q->where('status', 'rejected'));
            },
        ])->latest()->get();

        return view('manager.reports', [
            'statusData' => $statusData,
            'totalApplications' => $applications->count(),
            'summary' => $this->buildStats($applications),
            'reportRows' => $reportRows,
        ]);
    }

    public function assign(Request $request, Application $application)
    {
        $validated = $request->validate([
            'asesor_id' => ['required', 'exists:asesors,id'],
        ]);

        $application->load('latestAssignment');
        $asesor = Asesor::with('prodis')->findOrFail($validated['asesor_id']);

        if ($application->status !== 'submitted') {
            return back()->withErrors(['asesor_id' => 'Application cannot be assigned because its status is not submitted.']);
        }

        if ($application->latestAssignment) {
            return back()->withErrors(['asesor_id' => 'Application already assigned.']);
        }

        if (! $asesor->prodis->contains('id', $application->prodi_id)) {
            return back()->withErrors(['asesor_id' => 'Asesor prodi mismatch.']);
        }

        $manager = Auth::user()?->rplManager ?: RplManager::first();

        if (! $manager) {
            return back()->withErrors(['asesor_id' => 'No RPL manager profile is available for this assignment.']);
        }

        DB::transaction(function () use ($application, $manager, $validated) {
            Assignment::create([
                'application_id' => $application->id,
                'manager_id' => $manager->id,
                'asesor_id' => $validated['asesor_id'],
                'assigned_at' => now(),
            ]);

            $application->update(['status' => 'assigned']);
        });

        return redirect()->route('manager.assignment')->with('success', 'Asesor assigned successfully.');
    }

    private function managerApplicationsQuery()
    {
        return Application::with([
            'applicant',
            'prodi',
            'konsentrasi',
            'latestAssignment.asesor',
            'latestAssignment.manager',
        ])
            ->whereIn('status', self::MANAGER_STATUSES)
            ->latest();
    }

    private function buildStats($applications): array
    {
        return [
            'total' => $applications->count(),
            'submitted' => $applications->where('status', 'submitted')->count(),
            'assigned' => $applications->whereIn('status', ['assigned', 'assessed'])->count(),
            'completed' => $applications->whereIn('status', ['approved', 'rejected'])->count(),
            'approved' => $applications->where('status', 'approved')->count(),
            'rejected' => $applications->where('status', 'rejected')->count(),
        ];
    }

    private function statusBarColor(string $status): string
    {
        return match ($status) {
            'submitted' => 'bg-blue-500',
            'assigned' => 'bg-purple-500',
            'assessed' => 'bg-yellow-500',
            'approved' => 'bg-green-500',
            'rejected' => 'bg-red-500',
            default => 'bg-gray-500',
        };
    }
}

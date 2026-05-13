<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Application;
use App\Models\Assignment;
use App\Models\Asesor;

class AssignmentController extends Controller
{
    // Get submitted applications
    public function getSubmittedApplications()
    {
        $applications = Application::with([
            'applicant',
            'prodi',
            'konsentrasi',
            'latestAssignment.asesor',
            'latestAssignment.manager'
        ])
        ->whereIn('status', [
            'submitted',
            'assigned',
            'assessed',
            'approved',
        ])
        ->latest()
        ->get();

        return response()->json($applications);
    }

    // Get application detail
    public function getApplicationDetail($id)
    {
        $application = Application::with([
            'applicant',
            'prodi',
            'konsentrasi',
            'documents',
            'learningExperiences',
            'assignments.asesor',
            'assignments.manager',
        ])->find($id);

        if (!$application) {
            return response()->json([
                'message' => 'Application not found'
            ], 404);
        }

        return response()->json($application);
    }

    // Get asesor list by application prodi
    public function getAsesors($applicationId)
    {
        $application = Application::find($applicationId);

        if (!$application) {
            return response()->json([
                'message' => 'Application not found'
            ], 404);
        }

        $asesors = Asesor::with('prodis')
            ->whereHas('prodis', function ($query) use ($application) {
                $query->where(
                    'prodis.id',
                    $application->prodi_id
                );
            })
            ->latest()
            ->get();

        return response()->json($asesors);
    }

    // Assign asesor
    public function assignAsesor(Request $request, $applicationId)
    {
        $request->validate([
            'asesor_id' => 'required|exists:asesors,id',
        ]);

        $manager = $request->user()->rplManager;

        $application = Application::find($applicationId);

        if (!$application) {
            return response()->json([
                'message' => 'Application not found'
            ], 404);
        }

        // check double assignment
        if ($application->latestAssignment) {
            return response()->json([
                'message' => 'Application already assigned'
            ], 403);
        }


        $asesor = Asesor::find($request->asesor_id);

        // use pivot table asesor_prodis
        $matchProdi = $asesor->prodis()
            ->where('prodis.id', $application->prodi_id)
            ->exists();

        if (!$matchProdi) {
            return response()->json([
                'message' => 'Asesor prodi mismatch'
            ], 403);
        }

        // only submitted application can be assigned
        if ($application->status !== 'submitted') {
            return response()->json([
                'message' => 'Application cannot be assigned'
            ], 403);
        }

        $assignment = Assignment::create([
            'application_id' => $application->id,
            'manager_id' => $manager->id,
            'asesor_id' => $request->asesor_id,
            'assigned_at' => now(),
        ]);

        // update application status after assignment
        $application->update([
            'status' => 'assigned'
        ]);

        return response()->json([
            'message' => 'Asesor assigned successfully',
            'assignment' => $assignment
        ], 201);
    }

    // Get assignment history
    public function getAssignmentHistory($applicationId)
    {
        $assignments = Assignment::with([
            'asesor',
            'manager'
        ])
        ->where('application_id', $applicationId)
        ->latest()
        ->get();

        return response()->json($assignments);
    }
}
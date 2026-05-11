<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Application;

class ApplicationController extends Controller
{
    //Create Application
    public function createApplication(Request $request)
    {
        $request->validate([
            'jenis_rpl' => 'required|in:A,B',
            'prodi_id' => 'required|exists:prodis,id',
            'konsentrasi_id' => 'nullable|exists:konsentrasis,id',
        ]);

        $applicant = $request->user()->applicant;

        $application = Application::create([
            'applicant_id' => $applicant->id,
            'jenis_rpl' => $request->jenis_rpl,
            'prodi_id' => $request->prodi_id,
            'konsentrasi_id' => $request->konsentrasi_id,
            'status' => 'draft',
        ]);

        return response()->json([
            'message' => 'Application created successfully',
            'application' => $application
        ], 201);
    }

    //Get own applications
    public function getMyApplications(Request $request)
    {
        $applications = Application::with([
            'prodi',
            'konsentrasi'
        ])
        ->where('applicant_id', $request->user()->applicant->id)
        ->latest()
        ->get();

        return response()->json($applications);
    }

    // Get detail application
    public function getApplicationDetail(Request $request, $id)
    {
        $application = Application::with([
            'prodi',
            'konsentrasi'
        ])
        ->where('applicant_id', $request->user()->applicant->id)
        ->find($id);

        if (!$application) {
            return response()->json([
                'message' => 'Application not found'
            ], 404);
        }

        return response()->json($application);
    }

    // Update application
    public function updateApplication(Request $request, $id)
    {
        $application = Application::where(
            'applicant_id',
            $request->user()->applicant->id
        )->find($id);

        if (!$application) {
            return response()->json([
                'message' => 'Application not found'
            ], 404);
        }

        if ( $application->status !== 'draft' && $application->status !== 'rejected'){
            return response()->json([
                'message' => 'Application cannot be updated'
            ], 403);
        }

        $request->validate([
            'jenis_rpl' => 'required|in:A,B',
            'prodi_id' => 'required|exists:prodis,id',
            'konsentrasi_id' => 'nullable|exists:konsentrasis,id',
        ]);

        $application->update([
            'jenis_rpl' => $request->jenis_rpl,
            'prodi_id' => $request->prodi_id,
            'konsentrasi_id' => $request->konsentrasi_id,
        ]);

        return response()->json([
            'message' => 'Application updated successfully',
            'application' => $application
        ]);
    }

    //Submit application
    public function submitApplication(Request $request, $id)
    {
        $application = Application::where(
            'applicant_id',
            $request->user()->applicant->id
        )->find($id);

        if (!$application) {
            return response()->json([
                'message' => 'Application not found'
            ], 404);
        }

        if ( $application->status !== 'draft' && $application->status !== 'rejected') {
            return response()->json([
                'message' => 'Application already submitted'
            ], 403);
        }

        //check applicants document
        if ($application->documents()->count() < 1) {
            return response()->json([
                'message' => 'Document is required'
            ], 422);
        }

        //check learning experiences
        if ($application->learningExperiences()->count() < 1) {
            return response()->json([
                'message' => 'Learing experiences must be fill'
            ], 422);
        }

        $application->update([
            'status' => 'submitted'
        ]);

        return response()->json([
            'message' => 'Application submitted successfully',
            'application' => $application
        ]);
    }

    // Cancel application
    public function cancelApplication(Request $request, $id)
    {
        $application = Application::where(
            'applicant_id',
            $request->user()->applicant->id
        )->find($id);

        if (!$application) {
            return response()->json([
                'message' => 'Application not found'
            ], 404);
        }

        if ( $application->status !== 'draft' && $application->status !== 'submitted') {
            return response()->json([
                'message' => 'Application cannot be cancelled'
            ], 403);
        }

        $application->update([
            'status' => 'cancelled'
        ]);

        return response()->json([
            'message' => 'Application cancelled successfully',
            'application' => $application
        ]);
    }
}

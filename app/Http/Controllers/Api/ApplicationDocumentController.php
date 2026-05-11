<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Application;
use App\Models\ApplicationDocument;
use Illuminate\Support\Facades\Storage;

class ApplicationDocumentController extends Controller
{
    // Upload Document
    public function uploadDocument(Request $request, $applicationId)
    {
        $request->validate([
            'type' => 'required',
            'file' => 'required|mimes:pdf,jpg,jpeg,png|max:3072',
        ]);

        $application = Application::where(
            'applicant_id',
            $request->user()->applicant->id
        )->find($applicationId);

        if (!$application) {
            return response()->json([
                'message' => 'Application not found'
            ], 404);
        }

        if ( $application->status !== 'draft' && $application->status !== 'rejected') {
            return response()->json([
                'message' => 'Document upload not allowed'
            ], 403);
        }

        $path = $request->file('file')->store(
            'documents',
            'public'
        );

        $document = ApplicationDocument::create([
            'application_id' => $application->id,
            'type' => $request->type,
            'file_path' => $path,
        ]);

        return response()->json([
            'message' => 'Document uploaded successfully',
            'document' => $document
        ], 201);
    }

    // Get Documents
    public function getDocuments(Request $request, $applicationId)
    {
        $application = Application::where(
            'applicant_id',
            $request->user()->applicant->id
        )->find($applicationId);

        if (!$application) {
            return response()->json([
                'message' => 'Application not found'
            ], 404);
        }

        return response()->json(
            $application->documents
        );
    }

    //Update document
    public function updateDocument(Request $request, $id)
    {
        $request->validate([
            'type' => 'required',
            'file' => 'required|mimes:pdf,jpg,jpeg,png|max:3072',
        ]);

        $document = ApplicationDocument::whereHas(
            'application',
            function($query) use ($request) {
                $query->where(
                    'applicant_id',
                    $request->user()->applicant->id
                );
            }
        )->find($id);

        if (!$document) {
            return response()->json([
                'message' => 'Document not found'
            ], 404);
        }

        if ( $document->application->status !== 'draft' && $document->application->status !== 'rejected') {
            return response()->json([
                'message' => 'Document cannot be updated'
            ], 403);
        }

        //delete old file
        Storage::disk('public')->delete(
            $document->file_path
        );

        //upload new file
        $path = $request->file('file')->store(
            'documents',
            'public'
        );

        $document->update([
            'type' => $request->type,
            'file_path' => $path,
        ]);

        return response()->json([
            'message' => 'Document updated successfully',
            'document' => $document
        ]);
    }
}

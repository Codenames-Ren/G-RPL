<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Application;
use App\Models\LearningExperience;

class LearningExperienceController extends Controller
{
    // Create learning experience
    public function createLearningExperience(Request $request, $applicationId)
    {
        $request->validate([
            'title' => 'required',
            'type' => 'required|in:course,experience',
            'description' => 'nullable',
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

        if ($application->status !== 'draft' && $application->status !== 'rejected') {
            return response()->json([
                'message' => 'Learning experience cannot be added'
            ], 403);
        }

        $learningExperience = LearningExperience::create([
            'application_id' => $application->id,
            'title' => $request->title,
            'type' => $request->type,
            'description' => $request->description,
        ]);

        return response()->json([
            'message' => 'Learning experience created successfully',
            'learning_experience' => $learningExperience
        ], 201);
    }

    // Get learning experiences
    public function getLearningExperiences(Request $request, $applicationId)
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
            $application->learningExperiences
        );
    }

    // Update learning experience
    public function updateLearningExperience(Request $request, $id)
    {
        $request->validate([
            'title' => 'required',
            'type' => 'required|in:course,experience',
            'description' => 'nullable',
        ]);

        $learningExperience = LearningExperience::whereHas(
            'application',
            function ($query) use ($request) {
                $query->where(
                    'applicant_id',
                    $request->user()->applicant->id
                );
            }
        )->find($id);

        if (!$learningExperience) {
            return response()->json([
                'message' => 'Learning experience not found'
            ], 404);
        }

        if ($learningExperience->application->status !== 'draft' && $learningExperience->application->status !== 'rejected') {
            return response()->json([
                'message' => 'Learning experience cannot be updated'
            ], 403);
        }

        $learningExperience->update([
            'title' => $request->title,
            'type' => $request->type,
            'description' => $request->description,
        ]);

        return response()->json([
            'message' => 'Learning experience updated successfully',
            'learning_experience' => $learningExperience
        ]);
    }
}
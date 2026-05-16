<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use App\Models\Application;
use App\Models\Assessment;
use App\Models\AssessmentDetail;
use App\Models\Course;

class AsesorController extends Controller
{   
    // Get assigned applications
    public function getAssignedApplications(Request $request)
    {
        $asesor = $request->user()->asesor;

        $applications = Application::with([
            'applicant',
            'prodi',
            'konsentrasi',
            'latestAssignment.manager',
            'assessments'
        ])
        ->whereIn('status', [
            'assigned',
            'approved',
            'rejected',
        ])
        ->whereHas('latestAssignment', function ($query) use ($asesor) {
            $query->where('asesor_id', $asesor->id);
        })
        ->latest()
        ->get();

        return response()->json($applications);
    }

    // Get application detail
    public function getApplicationDetail(Request $request, $id)
    {
        $asesor = $request->user()->asesor;

        $application = Application::with([
            'applicant',
            'prodi',
            'konsentrasi',
            'documents',
            'learningExperiences',
            'latestAssignment.manager',
            'assessments.assessmentDetails.course',
        ])
        ->whereHas('latestAssignment', function ($query) use ($asesor) {
            $query->where('asesor_id', $asesor->id);
        })
        ->find($id);

        if (!$application) {
            return response()->json([
                'message' => 'Application not found'
            ], 404);
        }

        return response()->json($application);
    }

    // Get available courses
    public function getAvailableCourses($applicationId)
    {
        $application = Application::find($applicationId);

        if (!$application) {
            return response()->json([
                'message' => 'Application not found'
            ], 404);
        }

        $courses = Course::with([
            'prodi',
            'konsentrasi'
        ])
        ->where('prodi_id', $application->prodi_id)
        ->where(function ($query) use ($application) {
            $query->where(
                'konsentrasi_id', $application->konsentrasi_id
            )
            ->orWhereNull('konsentrasi_id');
        })
        ->latest()
        ->get();

        return response()->json($courses);
    }

    // create assessment
    public function createAssessment(Request $request, $applicationId)
    {
        $request->validate([
            'status' => 'required|in:approved,rejected',
            'notes' => 'nullable|string',

            // assessment details only required for approved
            'assessment_details' => 'required_if:status,approved|array|min:1',

            'assessment_details.*.learning_experience_id' => 'required_if:status,approved|exists:learning_experiences,id',

            'assessment_details.*.sks_diakui' => 'required_if:status,approved|integer|min:0',

            'assessment_details.*.nilai_konversi' => 'required_if:status,approved|integer|min:0|max:100',
        ]);

        $asesor = $request->user()->asesor;

        $application = Application::with([
            'latestAssignment',
            'assessments'
        ])->find($applicationId);

        if (!$application) {
            return response()->json([
                'message' => 'Application not found'
            ], 404);
        }

        // only assigned application can be assessed
        if ($application->status !== 'assigned') {
            return response()->json([
                'message' => 'Application cannot be assessed'
            ], 403);
        }

        // make sure assignment belongs to current asesor
        if (!$application->latestAssignment || $application->latestAssignment->asesor_id !== $asesor->id) {
            return response()->json([
                'message' => 'Unauthorized assessment access'
            ], 403);
        }

        // prevent duplicate assessment
        if ($application->assessments()->exists()) {
            return response()->json([
                'message' => 'Application already assessed'
            ], 403);
        }

        DB::beginTransaction();

        try {

            // create assessment
            $assessment = Assessment::create([
                'application_id' => $application->id,
                'asesor_id' => $asesor->id,
                'notes' => $request->notes,
                'status' => $request->status,
            ]);

            // create assessment details only if approved
            if ($request->status === 'approved') {

                foreach ($request->assessment_details as $detail) {

                    // use existing course
                    if (isset($detail['course_id'])) {

                        $course = Course::find($detail['course_id']);

                        if (!$course) {
                            throw new \Exception('Course not found');
                        }

                    } else {

                        // create new course inline
                        $newCourse = $detail['new_course'] ?? null;

                        if (!$newCourse) {
                            throw new \Exception('Course data required');
                        }

                        $course = Course::create([
                            'prodi_id' => $application->prodi_id,
                            'konsentrasi_id' => $application->konsentrasi_id,
                            'kode_mk' => $newCourse['kode_mk'],
                            'nama_matkul' => $newCourse['nama_matkul'],
                            'sks' => $newCourse['sks'],
                        ]);
                    }

                    AssessmentDetail::create([
                        'assessment_id' => $assessment->id,
                        'learning_experience_id' => $detail['learning_experience_id'],
                        'course_id' => $course->id,
                        'sks_diakui' => $detail['sks_diakui'],
                        'nilai_konversi' => $detail['nilai_konversi'],
                    ]);
                }
            }

            // update application status
            $application->update([
                'status' => $request->status
            ]);

            DB::commit();

            return response()->json([
                'message' => 'Assessment created successfully',
                'assessment' => $assessment->load(
                    'assessmentDetails.course'
                )
            ], 201);

        } catch (\Exception $e) {

            DB::rollBack();

            return response()->json([
                'message' => $e->getMessage()
            ], 500);
        }
    }
}

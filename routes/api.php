<?php

use Illuminate\Support\Facades\Route;
use App\Models\User;
use Illuminate\Auth\Events\Verified;
use Illuminate\Http\Request;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\UserManagementController;
use App\Http\Controllers\Api\ApplicationController;
use App\Http\Controllers\Api\ApplicationDocumentController;
use App\Http\Controllers\Api\LearningExperienceController;
use App\Http\Controllers\Api\AssignmentController;
use App\Http\Controllers\Api\AsesorController;
use App\Models\Prodi;

//Auth Routes
Route::prefix('auth')->group(function () {

    Route::post('/register', [AuthController::class, 'register'])
        ->middleware('throttle:3,1');
    Route::post('/login', [AuthController::class, 'login'])
        ->middleware('throttle:5,1');

    Route::middleware('auth:sanctum')->group(function () {
        Route::get('/me', [AuthController::class, 'me']);
        Route::post('/logout', [AuthController::class, 'logout']);
    });

});

// Auth Verification Email
Route::get('/email/verify/{id}/{hash}', function (Request $request) {

    $user = User::find($request->id);

    if (!$user) {
        return response()->json([
            'message' => 'User not found'
        ], 404);
    }

    if (!hash_equals(
        (string) $request->hash,
        sha1($user->getEmailForVerification())
    )) {
        return response()->json([
            'message' => 'Invalid verification link'
        ], 403);
    }

    if (!$user->hasVerifiedEmail()) {
        $user->markEmailAsVerified();
        event(new Verified($user));
    }

    return response()->json([
        'message' => 'Email verified successfully'
    ]);

})->middleware('signed')->name('api.verification.verify');

// Auth superadmin role
Route::middleware(['auth:sanctum', 'role:superadmin'])->group(function () {

    Route::post('/staff', [UserManagementController::class, 'createUser']);
    Route::get('/staff', [UserManagementController::class, 'getUsers']);
    Route::patch('/staff/{id}/switch-status', [UserManagementController::class, 'toggleUserStatus']);
});

// Applicant Routes
Route::middleware([
    'auth:sanctum',
    'role:applicant'
])->group(function () {
    Route::get('/prodis', fn () => Prodi::with('konsentrasis')->orderBy('nama_prodi')->get());
    
    //Applications Route
    Route::post('/applications', [ApplicationController::class, 'createApplication'])
        ->middleware('throttle:10,1');
    
    Route::get('/applications', [ApplicationController::class, 'getMyApplications']);
    Route::get('/applications/{id}', [ApplicationController::class, 'getApplicationDetail']);

    Route::put('/applications/{id}', [ApplicationController::class, 'updateApplication'])
        ->middleware('throttle:5,1');
    
    Route::patch('/applications/{id}/submit', [ApplicationController::class, 'submitApplication'])
        ->middleware('throttle:5,1');
    
    Route::patch('/applications/{id}/cancel', [ApplicationController::class, 'cancelApplication'])
        ->middleware('throttle:5,1');
    

    // Route Documents
    Route::post('/applications/{applicationId}/documents', [ApplicationDocumentController::class, 'uploadDocument'])
        ->middleware('throttle:5,1');
    
    Route::get('/applications/{applicationId}/documents', [ApplicationDocumentController::class, 'getDocuments']);
    
    Route::put('/documents/{id}', [ApplicationDocumentController::class, 'updateDocument'])
        ->middleware('throttle:5,1');
    
    // Learning Experiences
    Route::post('/applications/{applicationId}/learning-experiences', [LearningExperienceController::class, 'createLearningExperience'])
        ->middleware('throttle:10,1');
    
    Route::get('/applications/{applicationId}/learning-experiences', [LearningExperienceController::class, 'getLearningExperiences']);

    Route::put('/learning-experiences/{id}', [LearningExperienceController::class, 'updateLearningExperience'])
        ->middleware('throttle:10,1');
});

// Manager Routes
Route::middleware([
    'auth:sanctum',
    'role:manager'
])->group(function () {
    
    // get submitted application
    Route::get('/manager/applications', [
        AssignmentController::class, 'getSubmittedApplications'
    ]);

    //get application detail
    Route::get('/manager/applications/{id}', [
        AssignmentController::class, 'getApplicationDetail'
    ]);

    // Get asesors by application
    Route::get('/manager/applications/{applicationId}/asesors', [
        AssignmentController::class, 'getAsesors'
    ]);

    // Assign asesor
    Route::post('/manager/applications/{applicationId}/assign', [
        AssignmentController::class, 'assignAsesor'
    ])->middleware('throttle:5,1');

    //get assignment history
    Route::get('/manager/applications/{applicationId}/assignments', [
        AssignmentController::class, 'getAssignmentHistory'
    ]);

    // Reject application
    Route::patch('/manager/applications/{applicationId}/reject', [
        AssignmentController::class, 'rejectApplication'
    ])->middleware('throttle:5,1');
});

// Asesor Routes
Route::middleware([
    'auth:sanctum',
    'role:asesor'
])->group(function () {

    // get assigned applications
    Route::get('/asesor/applications', [
        AsesorController::class, 'getAssignedApplications'
    ]);

    // get application detail
    Route::get('/asesor/applications/{id}', [
        AsesorController::class, 'getApplicationDetail'
    ]);

    // get available courses
    Route::get('/asesor/applications/{applicationId}/courses', [
        AsesorController::class, 'getAvailableCourses'
    ]);

    // create assessment
    Route::post('/asesor/applications/{applicationId}/assessment', [
        AsesorController::class, 'createAssessment'
    ])->middleware('throttle:5,1');
});
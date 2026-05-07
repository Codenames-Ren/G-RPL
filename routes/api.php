<?php

use Illuminate\Support\Facades\Route;
use App\Models\User;
use Illuminate\Auth\Events\Verified;
use Illuminate\Http\Request;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\UserManagementController;

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

})->middleware('signed')->name('verification.verify');

Route::middleware(['auth:sanctum', 'role:superadmin'])->group(function () {

    Route::post('/staff', [UserManagementController::class, 'createUser']);
    Route::get('/staff', [UserManagementController::class, 'getUsers']);
    Route::patch('/staff/{id}/switch-status', [UserManagementController::class, 'toggleUserStatus']);
});
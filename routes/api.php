<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
*/

// Public routes
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);
Route::post('/login/custom-token', [AuthController::class, 'loginWithCustomToken']);
Route::get('/firebase-check', [AuthController::class, 'checkFirebaseConnection']);

// Protected routes - require authentication
Route::middleware('auth:sanctum')->group(function () {
    // Auth routes
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::get('/profile', [AuthController::class, 'profile']);
    Route::put('/profile/update', [AuthController::class, 'updateProfile']);
    Route::put('/profile/change-password', [AuthController::class, 'changePassword']);
    Route::delete('/profile/delete', [AuthController::class, 'deleteAccount']);
});

// Health check
Route::get('/health', function () {
    return response()->json([
        'status' => 'healthy',
        'service' => 'Gym API',
        'version' => '1.0.0',
        'timestamp' => now()->toISOString(),
    ]);
});
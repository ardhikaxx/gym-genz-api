<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\FoodController;

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

    // Foodplan routes
    Route::get('/foods', [FoodController::class, 'getFoods']);

    // Auth routes
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::get('/profile', [AuthController::class, 'profile']);
    Route::put('/profile/update', [AuthController::class, 'updateProfile']);
    Route::put('/profile/change-password', [AuthController::class, 'changePassword']);
    Route::delete('/profile/delete', [AuthController::class, 'deleteAccount']);
});
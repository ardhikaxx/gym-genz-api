<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\FoodController;
use App\Http\Controllers\Api\JadwalController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
*/

// Public routes
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);
Route::post('/validate-token', [AuthController::class, 'validateToken']);

// Protected routes - require authentication
Route::middleware('auth.token')->group(function () {

    // Foodplan routes
    Route::get('/foods', [FoodController::class, 'getFoods']);

    // Jadwal routes
    Route::get('/jadwal/today', [JadwalController::class, 'getTodaySchedules']);

    // Auth + Profile routes
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::get('/profile', [AuthController::class, 'profile']);
    Route::put('/profile/update', [AuthController::class, 'updateProfile']);
    Route::post('/profile/change-password', [AuthController::class, 'changePassword']);
});
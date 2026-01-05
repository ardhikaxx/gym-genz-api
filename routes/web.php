<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ManajemenPenggunaController;
use App\Http\Controllers\ManajemenFoodController;
use App\Http\Controllers\ManajemenJadwalController;
use App\Http\Controllers\ManajemenWorkoutController;
use App\Http\Controllers\ManajemenAdminController;
use App\Http\Controllers\DashboardController;

// Auth Routes
Route::get('/', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.post');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Admin Routes
Route::middleware(['auth:admin'])->group(function () {
    // Dashboard
    Route::get('/admin/dashboard', [DashboardController::class, 'index'])->name('admin.dashboard');
    Route::get('/admin/dashboard/stats', [DashboardController::class, 'getStats'])->name('admin.dashboard.stats');

    // Manajemen Pengguna
    Route::get('/admin/manajemen-pengguna', [ManajemenPenggunaController::class, 'index'])->name('manajemen-pengguna.index');
    Route::get('/admin/manajemen-pengguna/{id}', [ManajemenPenggunaController::class, 'show'])->name('manajemen-pengguna.show');
    Route::delete('/admin/manajemen-pengguna/{id}', [ManajemenPenggunaController::class, 'destroy'])->name('manajemen-pengguna.destroy');

    // Manajemen Food Plan
    Route::get('/admin/manajemen-food', [ManajemenFoodController::class, 'index'])->name('manajemen-food.index');
    Route::post('/admin/manajemen-food', [ManajemenFoodController::class, 'store'])->name('manajemen-food.store');
    Route::get('/admin/manajemen-food/{id}', [ManajemenFoodController::class, 'show'])->name('manajemen-food.show');
    Route::put('/admin/manajemen-food/{id}', [ManajemenFoodController::class, 'update'])->name('manajemen-food.update');
    Route::delete('/admin/manajemen-food/{id}', [ManajemenFoodController::class, 'destroy'])->name('manajemen-food.destroy');

    // Manajemen Jadwal Workout
    Route::get('/admin/manajemen-jadwal', [ManajemenJadwalController::class, 'index'])->name('manajemen-jadwal.index');
    Route::post('/admin/manajemen-jadwal', [ManajemenJadwalController::class, 'store'])->name('manajemen-jadwal.store');
    Route::get('/admin/manajemen-jadwal/{id}', [ManajemenJadwalController::class, 'show'])->name('manajemen-jadwal.show');
    Route::put('/admin/manajemen-jadwal/{id}', [ManajemenJadwalController::class, 'update'])->name('manajemen-jadwal.update');
    Route::delete('/admin/manajemen-jadwal/{id}', [ManajemenJadwalController::class, 'destroy'])->name('manajemen-jadwal.destroy');

    // Manajemen Workout
    Route::get('/admin/manajemen-workout', [ManajemenWorkoutController::class, 'index'])->name('manajemen-workout.index');
    Route::post('/admin/manajemen-workout', [ManajemenWorkoutController::class, 'store'])->name('manajemen-workout.store');
    Route::get('/admin/manajemen-workout/{id}', [ManajemenWorkoutController::class, 'show'])->name('manajemen-workout.show');
    Route::put('/admin/manajemen-workout/{id}', [ManajemenWorkoutController::class, 'update'])->name('manajemen-workout.update');
    Route::delete('/admin/manajemen-workout/{id}', [ManajemenWorkoutController::class, 'destroy'])->name('manajemen-workout.destroy');
    Route::get('/admin/manajemen-workout/jadwals/available', [ManajemenWorkoutController::class, 'getAvailableJadwals'])->name('manajemen-workout.get-jadwals');

    // Manajemen Admin
    Route::get('/admin/manajemen-admin', [ManajemenAdminController::class, 'index'])->name('manajemen-admin.index');
    Route::post('/admin/manajemen-admin', [ManajemenAdminController::class, 'store'])->name('manajemen-admin.store');
    Route::get('/admin/manajemen-admin/{id}', [ManajemenAdminController::class, 'show'])->name('manajemen-admin.show');
    Route::post('/admin/manajemen-admin/{id}', [ManajemenAdminController::class, 'update'])->name('manajemen-admin.update');
    Route::delete('/admin/manajemen-admin/{id}', [ManajemenAdminController::class, 'destroy'])->name('manajemen-admin.destroy');
    Route::delete('/admin/manajemen-admin/{id}/remove-photo', [ManajemenAdminController::class, 'removePhoto'])->name('manajemen-admin.remove-photo');

    // Profile Routes
    Route::get('/admin/profile', [ProfileController::class, 'index'])->name('admin.profile');
    Route::post('/admin/profile/update', [ProfileController::class, 'update'])->name('admin.profile.update');
    Route::post('/admin/profile/password', [ProfileController::class, 'updatePassword'])->name('admin.profile.password');
    Route::post('/admin/profile/remove-photo', [ProfileController::class, 'removePhoto'])->name('admin.profile.remove-photo');
});
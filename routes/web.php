<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ManajemenPenggunaController;
use App\Http\Controllers\ManajemenAdminController;

// Auth Routes
Route::get('/', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.post');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Admin Routes
Route::middleware(['auth:admin'])->group(function () {
    Route::get('/admin/dashboard', function () {
        return view('admins.dashboard.index');
    })->name('admin.dashboard');

    // Manajemen Pengguna
Route::get('/manajemen-pengguna', [ManajemenPenggunaController::class, 'index'])->name('manajemen-pengguna.index');
Route::get('/manajemen-pengguna/{id}', [ManajemenPenggunaController::class, 'show'])->name('manajemen-pengguna.show');
Route::delete('/manajemen-pengguna/{id}', [ManajemenPenggunaController::class, 'destroy'])->name('manajemen-pengguna.destroy');

    // Manajemen Admin
    Route::get('/manajemen-admin', [ManajemenAdminController::class, 'index'])->name('manajemen-admin.index');
    Route::post('/manajemen-admin', [ManajemenAdminController::class, 'store'])->name('manajemen-admin.store');
    Route::get('/manajemen-admin/{id}', [ManajemenAdminController::class, 'show'])->name('manajemen-admin.show');
    Route::put('/manajemen-admin/{id}', [ManajemenAdminController::class, 'update'])->name('manajemen-admin.update');
    Route::delete('/manajemen-admin/{id}', [ManajemenAdminController::class, 'destroy'])->name('manajemen-admin.destroy');
    Route::delete('/manajemen-admin/{id}/remove-photo', [ManajemenAdminController::class, 'removePhoto'])->name('manajemen-admin.remove-photo');

    // Profile Routes
    Route::get('/admin/profile', [ProfileController::class, 'index'])->name('admin.profile');
    Route::post('/admin/profile/update', [ProfileController::class, 'update'])->name('admin.profile.update');
    Route::post('/admin/profile/password', [ProfileController::class, 'updatePassword'])->name('admin.profile.password');
    Route::post('/admin/profile/remove-photo', [ProfileController::class, 'removePhoto'])->name('admin.profile.remove-photo');
});
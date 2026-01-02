<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('auth.login');
});


Route::get('/admin/dashboard', function () {
    return view('admins.dashboard.index');
})->name('admin.dashboard');
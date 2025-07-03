<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\KepalaController;
use App\Http\Controllers\TimController;
use App\Http\Controllers\KIController;

// Halaman utama / landing
Route::get('/', [AuthController::class, 'showLoginForm'])->name('landing');

// Login & Logout
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Dashboard sesuai role
Route::middleware('auth')->group(function () {
    Route::get('/dashboard', [AuthController::class, 'dashboard'])->name('dashboard');

    Route::get('/kepala/dashboard', [KepalaController::class, 'index'])->name('kepala.dashboard');
    Route::get('/tim/dashboard', [TimController::class, 'index'])->name('tim.dashboard');
    Route::get('/ki/dashboard', [KIController::class, 'index'])->name('ki.dashboard');

    Route::get('/profile', [AuthController::class, 'profile'])->name('profile');
    Route::post('/profile/update', [AuthController::class, 'updateProfile'])->name('profile.update');
    Route::post('/profile/password', [AuthController::class, 'updatePassword'])->name('profile.password');
});

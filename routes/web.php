<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\LandingController;


Route::get('/', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::get('/dashboard', [AuthController::class, 'dashboard'])->middleware('auth');
Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth');
Route::get('/profile', [AuthController::class, 'profile'])->middleware('auth');
Route::post('/profile', [AuthController::class, 'updateProfile'])->middleware('auth');
Route::post('/update-password', [AuthController::class, 'updatePassword'])->middleware('auth');
Route::get('/login', function () {
    return view('halamanlog'); // ganti dengan nama view login kamu
})->name('login');

    Route::get('/', [LandingController::class, 'index'])->name('landing');




// Protected Routes
Route::middleware('auth')->group(function () {
    Route::get('/dashboard', [AuthController::class, 'dashboard'])->name('dashboard');
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
});
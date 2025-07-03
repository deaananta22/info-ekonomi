<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AgendaController;

Route::get('/', [AuthController::class, 'showLoginForm'])->name('login');
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::get('/dashboard', [AuthController::class, 'dashboard'])->middleware('auth');
Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth');
Route::get('/profile', [AuthController::class, 'profile'])->middleware('auth');
Route::post('/profile', [AuthController::class, 'updateProfile'])->middleware('auth');
Route::post('/update-password', [AuthController::class, 'updatePassword'])->middleware('auth');
Route::get('/agenda', [AgendaController::class, 'index'])->name('agenda');
Route::get('/rapat/create', [AgendaController::class, 'createRapat'])->name('rapat.create');
Route::post('/rapat', [AgendaController::class, 'storeRapat'])->name('rapat.store'); // ini buat simpan data
Route::get('/notulensi/create', [AgendaController::class, 'createNotulensi'])->name('notulensi.create');
// Protected Routes
Route::middleware('auth')->group(function () {
    Route::get('/dashboard', [AuthController::class, 'dashboard'])->name('dashboard');
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
});
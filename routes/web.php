<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\KepalaController;
use App\Http\Controllers\TimController;
use App\Http\Controllers\KIController;
use App\Http\Controllers\AgendaController;
use App\Http\Controllers\LandingController;


// Halaman utama / landing
Route::get('/', [AuthController::class, 'showLoginForm'])->name('landing');

// Login & Logout
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);

Route::get('/dashboard', [AuthController::class, 'dashboard'])->middleware('auth');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Dashboard sesuai role


// Dashboard per role
Route::middleware('auth')->group(function () {
    Route::get('/kepala/dashboard', [KepalaController::class, 'index']);
    Route::get('/ki/dashboard', [KIController::class, 'index']);
    Route::get('/tim/dashboard', [TimController::class, 'index']);
});

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
Route::get('/login', function () {
    return view('halamanlog'); // ganti dengan nama view login kamu
})->name('login');

    Route::get('/', [LandingController::class, 'index'])->name('landing');


// Protected Routes
Route::middleware('auth')->group(function () {
    Route::get('/dashboard', [AuthController::class, 'dashboard'])->name('dashboard');

    Route::get('/kepala/dashboard', [KepalaController::class, 'index'])->name('kepala.dashboard');
    Route::get('/tim/dashboard', [TimController::class, 'index'])->name('tim.dashboard');
    Route::get('/ki/dashboard', [KIController::class, 'index'])->name('ki.dashboard');

    Route::get('/profile', [AuthController::class, 'profile'])->name('profile');
    Route::post('/profile/update', [AuthController::class, 'updateProfile'])->name('profile.update');
    Route::post('/profile/password', [AuthController::class, 'updatePassword'])->name('profile.password');
});

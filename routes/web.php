<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\KepalaController;
use App\Http\Controllers\KIController;
use App\Http\Controllers\TimController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\LandingController;

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
// Kepala
Route::middleware(['auth', 'role:kepala'])->group(function () {
    Route::get('/kepala/dashboard', [KepalaController::class, 'index']);
});

// KI
Route::middleware(['auth', 'role:ki'])->group(function () {
    Route::get('/ki/dashboard', [KIController::class, 'index']);
});

// Tim
Route::middleware(['auth', 'role:tim'])->group(function () {
    Route::get('/tim/dashboard', [TimController::class, 'index']);
});

Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);

// Dashboard per role
Route::middleware('auth')->group(function () {
    Route::get('/kepala/dashboard', [KepalaController::class, 'index']);
    Route::get('/ki/dashboard', [KIController::class, 'index']);
    Route::get('/tim/dashboard', [TimController::class, 'index']);
});


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

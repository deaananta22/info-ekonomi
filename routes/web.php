<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\KepalaController;
use App\Http\Controllers\KIController;
use App\Http\Controllers\TimController;

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

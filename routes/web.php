<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ClubController;
use App\Http\Controllers\MatchController;
use App\Http\Controllers\StandingController;
use App\Http\Controllers\AuthController;

// public
Route::get('/', function () {
    return view('home');
})->name("home");

Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::get('/matches', [MatchController::class, 'index'])->name('matches.index');
Route::get('/standings', [StandingController::class, 'index'])->name('standings');
Route::get('/clubs', [ClubController::class, 'index'])->name('clubs.index');

// guest
Route::middleware('guest')->group(function() {
    Route::get('/login', [AuthController::class, 'showLogin'])->name('show.login');
    Route::post('/register', [AuthController::class, 'register'])->name('register');
    Route::post('/login', [AuthController::class, 'login'])->name('login');
    Route::get('/register', [AuthController::class, 'showRegister'])->name('show.register');
});

// auth
Route::middleware('auth')->group(function() {
    Route::get('/matches/{id}', [MatchController::class, 'show'])->name('matches.show');
    Route::get('/matches/matchday/{matchday}', [MatchController::class, 'byMatchday'])->name('matches.by-matchday');
    Route::get('/clubs/{club}', [ClubController::class, 'show'])->name('clubs.show');
});
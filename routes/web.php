<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ClubController;
use App\Http\Controllers\MatchController;
use App\Http\Controllers\StandingController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\MatchController as AdminMatchController;
use App\Http\Controllers\Admin\ClubController as AdminClubController;
use App\Http\Controllers\Admin\PlayerController as AdminPlayerController;
use App\Http\Controllers\Admin\StandingController as AdminStandingController;

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

// must login
Route::middleware('auth')->group(function() {
    Route::get('/matches/{id}', [MatchController::class, 'show'])->name('matches.show');
    Route::get('/matches/matchday/{matchday}', [MatchController::class, 'byMatchday'])->name('matches.by-matchday');
    Route::get('/clubs/{club}', [ClubController::class, 'show'])->name('clubs.show');
});

// must club manager
Route::middleware('is_club_manager')->group(function() {

});

// must admin
Route::middleware('is_admin')->prefix('admin')->name('admin.')->group(function() {
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('dashboard');
    
    // matches
    Route::get('/matches', [AdminMatchController::class, 'index'])->name('matches.index');
    Route::get('/matches/create', [AdminMatchController::class, 'create'])->name('matches.create');
    Route::post('/matches', [AdminMatchController::class, 'store'])->name('matches.store');
    Route::get('/matches/{match}/edit', [AdminMatchController::class, 'edit'])->name('matches.edit');
    Route::put('/matches/{match}', [AdminMatchController::class, 'update'])->name('matches.update');
    Route::delete('/matches/{match}', [AdminMatchController::class, 'destroy'])->name('matches.destroy');
    
    // clubs
    Route::get('/clubs', [AdminClubController::class, 'index'])->name('clubs.index');
    Route::get('/clubs/{club}/edit', [AdminClubController::class, 'edit'])->name('clubs.edit');
    Route::put('/clubs/{club}', [AdminClubController::class, 'update'])->name('clubs.update');
    
    // players
    Route::get('/players', [AdminPlayerController::class, 'index'])->name('players.index');
    Route::get('/players/create', [AdminPlayerController::class, 'create'])->name('players.create');
    Route::post('/players', [AdminPlayerController::class, 'store'])->name('players.store');
    Route::get('/players/{player}/edit', [AdminPlayerController::class, 'edit'])->name('players.edit');
    Route::put('/players/{player}', [AdminPlayerController::class, 'update'])->name('players.update');
    Route::delete('/players/{player}', [AdminPlayerController::class, 'destroy'])->name('players.destroy');
    
    // standings
    Route::get('/standings', [AdminStandingController::class, 'index'])->name('standings.index');
    Route::get('/standings/{standing}/edit', [AdminStandingController::class, 'edit'])->name('standings.edit');
    Route::put('/standings/{standing}', [AdminStandingController::class, 'update'])->name('standings.update');
});
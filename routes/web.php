<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ClubController;
use App\Http\Controllers\MatchController;
use App\Http\Controllers\StandingController;

Route::get('/', function () {
    return view('home');
})->name("home");

Route::get('/clubs', [ClubController::class, 'index'])->name('clubs.index');
Route::get('/clubs/{club}', [ClubController::class, 'show'])->name('clubs.show');

Route::get('/matches', [MatchController::class, 'index'])->name('matches.index');
Route::get('/matches/{id}', [MatchController::class, 'show'])->name('matches.show');
Route::get('/matches/matchday/{matchday}', [MatchController::class, 'byMatchday'])->name('matches.by-matchday');

Route::get('/standings', [StandingController::class, 'index'])->name('standings');
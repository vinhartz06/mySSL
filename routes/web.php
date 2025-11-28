<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ClubController;

Route::get('/', function () {
    return view('home');
})->name("home");

Route::get('/clubs', [ClubController::class, 'index'])->name('clubs.index');
Route::get('/clubs/{club}', [ClubController::class, 'show'])->name('clubs.show');

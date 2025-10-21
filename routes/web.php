<?php

use App\Http\Controllers\GameController;
use App\Http\Controllers\ReviewController;
use Illuminate\Support\Facades\Route;

Route::get('/', fn() => redirect()->route('games.index'));

Route::resource('games', GameController::class); // full CRUD

// keep reviews simple: only create (store) under a game
Route::post('/games/{game}/reviews', [ReviewController::class, 'store'])
    ->name('games.reviews.store');
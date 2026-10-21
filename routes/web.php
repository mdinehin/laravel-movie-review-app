<?php

use App\Http\Controllers\MovieController;
use App\Http\Controllers\ReviewController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect()->route('movies.index');
});

Route::resource('movies', MovieController::class)
    ->only(['index', 'show']);

Route::resource('movies.reviews', ReviewController::class)
    ->scoped(['review' => 'movie'])
    ->only(['create', 'store']);

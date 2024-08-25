<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TvController;
use App\Http\Controllers\ActorController;
use App\Http\Controllers\MovieController;


Route::group(['controller' => MovieController::class], function () {
    Route::get('/', 'all')->name('movie.all');
    Route::get('/movie/{id}', 'one')->name('movie.one');
});
Route::group(['controller' => TvController::class], function () {
    Route::get('/tv', 'all')->name('tv.all');
    Route::get('/tv/{id}', 'one')->name('tv.one');
});
Route::group(['controller' => ActorController::class], function () {
    Route::get('/actor', 'all')->name('actor.all');
    Route::get('/actor/page/{page?}', 'all');
    Route::get('/actor/{id}', 'one')->name('actor.one');
});

// Route::view('/', 'pages/movies/index');
// Route::view('/movie', 'pages/movies/show');

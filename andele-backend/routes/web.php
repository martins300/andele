<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RickAndMortyController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/api/list', [RickAndMortyController::class, 'list']);
Route::get('/api/character/{id}', [RickAndMortyController::class, 'character']);


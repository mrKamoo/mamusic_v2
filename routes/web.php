<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DiscogsController;
use App\Http\Livewire\AlbumSearch;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/albums', function () {
    return view('discogs');
})->name('albums.list');

Route::get('/albums/{id}', function ($id) {
    return view('album-detail', compact('id'));
})->name('album.show');

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});


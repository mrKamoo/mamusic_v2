<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DiscogsController;
use App\Http\Livewire\AlbumSearch;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/albums', [DiscogsController::class, 'index'])->name('albums.list');
Route::get('/albums/search', [DiscogsController::class, 'search'])->name('albums.search');
Route::get('/albums/{id}', [DiscogsController::class, 'show'])->name('album.show');

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});


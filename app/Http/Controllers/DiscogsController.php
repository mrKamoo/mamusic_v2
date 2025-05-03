<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\DiscogsService;
use App\Models\Album;

class DiscogsController extends Controller
{
    public function search(Request $request, DiscogsService $discogsService)
    {
        $query = $request->input('q', 'Daft Punk');
        $results = $discogsService->searchArtist($query);
        $results = $results['results'];
        return view('discogs', compact('results'));
    }

    public function showAlbums()
{
    $albums = Album::all();
    return view('discogs', compact('albums'));
}
}
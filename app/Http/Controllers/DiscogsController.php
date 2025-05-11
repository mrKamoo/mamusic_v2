<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\DiscogsService;
use App\Models\Album;

class DiscogsController extends Controller
{
    protected $discogsService;

    public function __construct(DiscogsService $discogsService)
    {
        $this->discogsService = $discogsService;
    }

    public function index()
    {
        $albums = Album::all();
        return view('discogs', compact('albums'));
    }

    public function show($id)
    {
        $album = Album::findOrFail($id);
        return view('album-detail', compact('album', 'id'));
    }

    public function search(Request $request)
    {
        $query = $request->input('q', 'Daft Punk');
        $results = $this->discogsService->searchArtist($query);
        $results = $results['results'];
        return view('discogs', compact('results'));
    }
}
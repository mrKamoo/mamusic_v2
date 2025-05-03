<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Album;

class AlbumSearch extends Component
{
    public $search = '';

    public function render()
    {
        $albums = Album::query()
            ->when($this->search, function($query) {
                $query->where('title', 'like', '%'.$this->search.'%')
                      ->orWhere('artist', 'like', '%'.$this->search.'%')
                      ->orWhere('barcode', 'like', '%'.$this->search.'%');
            })
            ->where('title', '!=', null)
            ->limit(64)
            ->orderBy('title', 'asc')
            ->get();

        $count = Album::where('title', '!=', null)->count();

        return view('livewire.album-search', compact('albums', 'count'));
    }
}
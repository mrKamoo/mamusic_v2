<?php
namespace App\Livewire;

use Livewire\Component;
use App\Models\Album;

class AlbumDetail extends Component
{
    public $id;

    public function render()
    {
        $album = Album::find($this->id);
        return view('livewire.album-detail', compact('album'));
    }
}
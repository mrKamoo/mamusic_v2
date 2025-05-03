<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Album;

class AlbumTop extends Component
{
    public $search = '';

    public function render()
    {

$id1 = '609';
$id2 = '4673';
$id3 = '4849';
$id4 = '4833';

$albums = Album::where('id',$id1)
->orwhere('id',$id2)
->orwhere('id',$id3)
->orwhere('id',$id4)
->get();

return view('livewire.album-top', compact('albums'));
}
}
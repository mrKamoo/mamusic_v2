<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Album extends Model
{
    protected $fillable = [
        'barcode',
        'title',
        'artist',
        'year',
        'label',
        'discogs_id',
        'raw_discogs',
        'repertory',
    ];
    //
}

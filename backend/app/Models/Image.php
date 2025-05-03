<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    protected $fillable = [
        'path',
        'position',
        'annonce_id',
    ];

    public function annonce()
    {
        return $this->belongsTo(Annonce::class);
    }
}

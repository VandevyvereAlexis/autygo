<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Avis extends Model
{
    protected $fillable = [
        'note',
        'commentaire',
        'acheteur_id',
        'vendeur_id',
    ];

    public function acheteur()
    {
        return $this->belongsTo(User::class, 'acheteur_id');
    }

    public function vendeur()
    {
        return $this->belongsTo(User::class, 'vendeur_id');
    }
}

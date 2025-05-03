<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Modele extends Model
{
    protected $fillable = ['nom', 'marque_id'];

    public function marque()
    {
        return $this->belongsTo(Marque::class);
    }

    public function annonces()
    {
        return $this->hasMany(Annonce::class);
    }
}

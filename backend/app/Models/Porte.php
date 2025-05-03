<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Porte extends Model
{
    protected $fillable = ['nom'];

    public function annonces()
    {
        return $this->hasMany(Annonce::class);
    }
}

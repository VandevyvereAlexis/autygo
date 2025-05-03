<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Annonce extends Model
{
    protected $fillable = [
        'titre',
        'vendu',
        'visible',
        'premiere_main',
        'prix',
        'kilometrage',
        'chevaux_fiscaux',
        'chevaux_din',
        'description',
        'ville',
        'code_postal',
        'latitude',
        'longitude',
        'user_id',
        'marque_id',
        'modele_id',
        'energie_id',
        'transmission_id',
        'type_id',
        'porte_id',
        'place_id',
        'couleur_id',
        'condition_id',
    ];

    protected $casts = [
        'vendu' => 'boolean',
        'visible' => 'boolean',
        'premiere_main' => 'boolean',
        'latitude' => 'float',
        'longitude' => 'float',
        'prix' => 'decimal:2',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function marque()
    {
        return $this->belongsTo(Marque::class);
    }

    public function modele()
    {
        return $this->belongsTo(Modele::class);
    }

    public function energie()
    {
        return $this->belongsTo(Energie::class);
    }

    public function transmission()
    {
        return $this->belongsTo(Transmission::class);
    }

    public function type()
    {
        return $this->belongsTo(Type::class);
    }

    public function porte()
    {
        return $this->belongsTo(Porte::class);
    }

    public function place()
    {
        return $this->belongsTo(Place::class);
    }

    public function couleur()
    {
        return $this->belongsTo(Couleur::class);
    }

    public function condition()
    {
        return $this->belongsTo(Condition::class);
    }

    public function images()
    {
        return $this->hasMany(Image::class);
    }

    public function favoris()
    {
        return $this->hasMany(Favoris::class);
    }

    public function conversations()
    {
        return $this->hasMany(Conversation::class);
    }
}

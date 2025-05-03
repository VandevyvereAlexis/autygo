<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Conversation extends Model
{
    protected $fillable = [
        'annonce_id',
        'acheteur_id',
        'vendeur_id',
        'last_message_at',
    ];

    protected $casts = [
        'last_message_at' => 'datetime',
    ];

    public function annonce()
    {
        return $this->belongsTo(Annonce::class);
    }

    public function acheteur()
    {
        return $this->belongsTo(User::class, 'acheteur_id');
    }

    public function vendeur()
    {
        return $this->belongsTo(User::class, 'vendeur_id');
    }

    public function messages()
    {
        return $this->hasMany(Message::class);
    }
}

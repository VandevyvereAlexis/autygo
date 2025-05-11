<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'nom',
        'prenom',
        'pseudo',
        'email',
        'image',
        'password',
        'role_id',
        'email_verification_token',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
        // 'email_verification_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
            'email_verification_token' => 'string',
        ];
    }

    public function role()
    {
        return $this->belongsTo(Role::class);
    }

    public function annonces()
    {
        return $this->hasMany(Annonce::class);
    }

    public function favoris()
    {
        return $this->hasMany(Favoris::class);
    }

    public function avisRecus()
    {
        return $this->hasMany(Avis::class, 'vendeur_id');
    }

    public function avisLaisses()
    {
        return $this->hasMany(Avis::class, 'acheteur_id');
    }

    public function messages()
    {
        return $this->hasMany(Message::class);
    }

    public function conversationsEnTantQuAcheteur()
    {
        return $this->hasMany(Conversation::class, 'acheteur_id');
    }

    public function conversationsEnTantQueVendeur()
    {
        return $this->hasMany(Conversation::class, 'vendeur_id');
    }
}

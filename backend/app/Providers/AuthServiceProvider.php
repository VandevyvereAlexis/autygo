<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

// Import des modèles
use App\Models\Role;
use App\Models\Marque;
use App\Models\Modele;
use App\Models\Energie;
use App\Models\Transmission;
use App\Models\Type;
use App\Models\Porte;
use App\Models\Place;
use App\Models\Couleur;
use App\Models\Condition;
use App\Models\User;
use App\Models\Avis;
use App\Models\Annonce;
use App\Models\Image;
use App\Models\Favoris;
use App\Models\Conversation;
use App\Models\Message;

// Import des policies
use App\Policies\RolePolicy;
use App\Policies\MarquePolicy;
use App\Policies\ModelePolicy;
use App\Policies\EnergiePolicy;
use App\Policies\TransmissionPolicy;
use App\Policies\TypePolicy;
use App\Policies\PortePolicy;
use App\Policies\PlacePolicy;
use App\Policies\CouleurPolicy;
use App\Policies\ConditionPolicy;
use App\Policies\UserPolicy;
use App\Policies\AvisPolicy;
use App\Policies\AnnoncePolicy;
use App\Policies\ImagePolicy;
use App\Policies\FavorisPolicy;
use App\Policies\ConversationPolicy;
use App\Policies\MessagePolicy;

class AuthServiceProvider extends ServiceProvider
{
     protected $policies = [
        Role::class         => RolePolicy::class,
        Marque::class       => MarquePolicy::class,
        Modele::class       => ModelePolicy::class,
        Energie::class      => EnergiePolicy::class,
        Transmission::class => TransmissionPolicy::class,
        Type::class         => TypePolicy::class,
        Porte::class        => PortePolicy::class,
        Place::class        => PlacePolicy::class,
        Couleur::class      => CouleurPolicy::class,
        Condition::class    => ConditionPolicy::class,
        User::class         => UserPolicy::class,
        Avis::class         => AvisPolicy::class,
        Annonce::class      => AnnoncePolicy::class,
        Image::class        => ImagePolicy::class,
        Favoris::class      => FavorisPolicy::class,
        Conversation::class => ConversationPolicy::class,
        Message::class      => MessagePolicy::class,
    ];

    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        $this->registerPolicies();
    }
}

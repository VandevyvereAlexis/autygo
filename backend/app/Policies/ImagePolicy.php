<?php

namespace App\Policies;

use App\Models\Image;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class ImagePolicy
{

    // Avant toute vérification, si l'utilisateur est admin, on autorise tout.
    public function before(User $user, $ability)
    {
        if ($user->role->nom === 'admin') {
            return true;
        }
    }


    // 1. index (viewAny) : tout le monde (public & connectés) peut lister les images.
    public function viewAny(?User $user): bool
    {
        return true;
    }


    // 2. show (view) : tout le monde (public & connectés) peut voir une image.
    public function view(?User $user, Image $image): bool
    {
        return true;
    }


    // 3. store (create) : tout utilisateur authentifié peut créer des images pour une de ses annonces (la FormRequest vérifie qu’il est bien propriétaire).
    public function create(User $user): bool
    {
        return true;
    }


    // 4. update : seuls les propriétaires de l'annonce (et admins) peuvent modifier.
    public function update(User $user, Image $image): bool
    {
        return $user->id === $image->annonce->user_id;
    }


    // 5. destroy : seuls les propriétaires de l'annonce (et admins) peuvent supprimer.
    public function delete(User $user, Image $image): bool
    {
        return $user->id === $image->annonce->user_id;
    }

}

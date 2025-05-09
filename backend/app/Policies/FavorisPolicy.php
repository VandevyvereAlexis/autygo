<?php

namespace App\Policies;

use App\Models\Favoris;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class FavorisPolicy
{

    // Avant toute vérification, si l'utilisateur est admin, on autorise tout.
    public function before(User $user, $ability)
    {
        if ($user->role->nom === 'admin') {
            return true;
        }
    }


    // 1. index (viewAny) : seuls les admins.
    public function viewAny(User $user): bool
    {
        return false;
    }


    // 2. store (create) : tout utilisateur authentifié peut créer SON favori.
    public function create(User $user): bool
    {
        return true;
    }


    // 3. show (view) : admin ou propriétaire du favori.
    public function view(User $user, Favoris $favoris): bool
    {
        return $user->id === $favoris->user_id;
    }


    // 4. update : seuls les admins.
    public function update(User $user, Favoris $favoris): bool
    {
        return false;
    }


    // 5. destroy (delete) : admin ou propriétaire du favori.
    public function delete(User $user, Favoris $favoris): bool
    {
        return $user->id === $favoris->user_id;
    }

}

<?php

namespace App\Policies;

use App\Models\Annonce;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class AnnoncePolicy
{

    // Avant toute vérification, si l'utilisateur est admin, on autorise tout.
    public function before(User $user, $ability)
    {
        if ($user->role->nom === 'admin') {
            return true;
        }
    }


    // 1. index (viewAny) : tout le monde (public & connectés).
    public function viewAny(?User $user): bool
    {
        return true;
    }


    // 3. show (view) : tout le monde (public & connectés).
    public function view(?User $user, Annonce $annonce): bool
    {
        return true;
    }


    // 2. store (create) : tout utilisateur connecté peut créer une annonce.
    public function create(User $user): bool
    {
        return true;
    }


    // 4. update : seul le propriétaire de l'annonce (user_id) peut modifier.
    public function update(User $user, Annonce $annonce): bool
    {
        return $user->id === $annonce->user_id;
    }


    // 5. destroy (delete) : seul le propriétaire de l'annonce (user_id) peut supprimer.
    public function delete(User $user, Annonce $annonce): bool
    {
        return $user->id === $annonce->user_id;
    }

}

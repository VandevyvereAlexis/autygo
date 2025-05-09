<?php

namespace App\Policies;

use App\Models\User;

class ProfilePolicy
{

    // Avant toute vérification, si l'utilisateur est admin, on autorise tout.
    public function before(User $user, $ability)
    {
        if ($user->role->nom === 'admin') {
            return true;
        }
    }


    // Détermine si $user peut voir son propre profil.
    public function view(User $user, User $model): bool
    {
        return $user->id === $model->id;
    }


    // Détermine si $user peut mettre à jour son propre profil.
    public function update(User $user, User $model): bool
    {
        return $user->id === $model->id;
    }


    // Détermine si $user peut changer son propre mot de passe.
    public function updatePassword(User $user, User $model): bool
    {
        return $user->id === $model->id;
    }

}

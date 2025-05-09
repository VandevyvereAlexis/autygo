<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Auth\Access\Response;

class UserPolicy
{

    // Avant toute vérification, si l'utilisateur est admin, on autorise tout.
    public function before(User $user, $ability)
    {
        return $user->role->nom === 'admin';
    }


    // 1. index : seuls les admins (before renvoie true pour eux, sinon false).
    public function viewAny(User $user): bool
    {
        return false;
    }


    // 2. show : seuls les admins.
    public function view(User $user, User $model): bool
    {
        return false;
    }


    // 3. store : seuls les admins.
    public function create(User $user): bool
    {
        return false;
    }


    // 4. update : seuls les admins.
    public function update(User $user, User $model): bool
    {
        return false;
    }


    // 5. destroy : seuls les admins.
    public function delete(User $user, User $model): bool
    {
        return false;
    }
}

<?php

namespace App\Policies;

use App\Models\Marque;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class MarquePolicy
{

    // Avant toute vérification, si l'utilisateur est admin, on autorise tout.
    public function before(User $user, $ability)
    {
        if ($user->role->nom === 'admin') {
            return true;
        }
    }


    // 1. index : tout le monde (public & utilisateurs connectés).
    public function viewAny(?User $user): bool
    {
        return true;
    }


    // 3. show : tout le monde (public & utilisateurs connectés).
    public function view(?User $user, Marque $marque): bool
    {
        return true;
    }


    // 2. store : seuls les admins (via before()).
    public function create(User $user): bool
    {
        return false;
    }


    // 4. update : seuls les admins (via before()).
    public function update(User $user, Marque $marque): bool
    {
        return false;
    }


    // 5. destroy : seuls les admins (via before()).
    public function delete(User $user, Marque $marque): bool
    {
        return false;
    }

}

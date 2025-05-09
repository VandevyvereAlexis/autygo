<?php

namespace App\Policies;

use App\Models\Porte;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class PortePolicy
{

    // Avant toute vérification, si l'utilisateur est admin, on autorise tout.
    public function before(User $user, $ability)
    {
        if ($user->role->nom === 'admin') {
            return true;
        }
    }


    // 1. index : tout le monde (public & connectés).
    public function viewAny(?User $user): bool
    {
        return true;
    }


    // 3. show : tout le monde (public & connectés).
    public function view(?User $user, Porte $porte): bool
    {
        return true;
    }


    // 2. store : seuls les admins.
    public function create(User $user): bool
    {
        return false;
    }


    // 4. update : seuls les admins.
    public function update(User $user, Porte $porte): bool
    {
        return false;
    }


    // 5. destroy : seuls les admins.
    public function delete(User $user, Porte $porte): bool
    {
        return false;
    }

}

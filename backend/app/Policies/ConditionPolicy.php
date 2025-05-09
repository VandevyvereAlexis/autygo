<?php

namespace App\Policies;

use App\Models\Condition;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class ConditionPolicy
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
    public function view(?User $user, Condition $condition): bool
    {
        return true;
    }


    // 2. store (create) : seuls les admins (via before()).
    public function create(User $user): bool
    {
        return false;
    }


    // 4. update : seuls les admins (via before()).
    public function update(User $user, Condition $condition): bool
    {
        return false;
    }


    // 5. destroy (delete) : seuls les admins (via before()).
    public function delete(User $user, Condition $condition): bool
    {
        return false;
    }

}

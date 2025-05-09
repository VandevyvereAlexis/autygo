<?php

namespace App\Policies;

use App\Models\Avis;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class AvisPolicy
{

    // Avant toute vérification, si l'utilisateur est admin, on autorise tout.
    public function before(User $user, $ability)
    {
        if ($user->role->nom === 'admin') {
            return true;
        }
    }


    // 1. index (viewAny) : tout le monde (public & connectés) peut voir la liste.
    public function viewAny(?User $user): bool
    {
        return true;
    }


    // 3. show (view) : tout le monde (public & connectés) peut voir un avis.
    public function view(?User $user, Avis $avis): bool
    {
        return true;
    }


    // 2. store (create) : tout utilisateur authentifié peut créer SON avis.
    public function create(User $user): bool
    {
        return true;
    }


    // 4. update : seul le créateur de l'avis (acheteur_id) peut le modifier.
    public function update(User $user, Avis $avis): bool
    {
        return $user->id === $avis->acheteur_id;
    }


    // 5. destroy (delete) : seul le créateur de l'avis (acheteur_id) peut le supprimer.
    public function delete(User $user, Avis $avis): bool
    {
        return $user->id === $avis->acheteur_id;
    }

}

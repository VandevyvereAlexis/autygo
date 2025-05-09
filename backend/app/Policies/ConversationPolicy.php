<?php

namespace App\Policies;

use App\Models\Conversation;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class ConversationPolicy
{

    // Avant toute vérification, si l'utilisateur est admin, on autorise tout.
    public function before(User $user, $ability)
    {
        if ($user->role->nom === 'admin') {
            return true;
        }
    }


    // 1. index (viewAny) : seuls les admins peuvent lister toutes les conversations.
    public function viewAny(User $user): bool
    {
        return false;
    }


    // 2. store (create) : tout utilisateur connecté peut démarrer une conversation.
    public function create(User $user): bool
    {
        return true;
    }


    // 3. show (view) : un participant (acheteur ou vendeur) peut voir sa conversation.
    public function view(User $user, Conversation $conversation): bool
    {
        return $user->id === $conversation->acheteur_id
            || $user->id === $conversation->vendeur_id;
    }


    // 4. update : idem, seul un participant peut modifier sa conversation.
    public function update(User $user, Conversation $conversation): bool
    {
        return $user->id === $conversation->acheteur_id
            || $user->id === $conversation->vendeur_id;
    }


    // 5. destroy : idem, seul un participant peut supprimer sa conversation.
    public function delete(User $user, Conversation $conversation): bool
    {
        return $user->id === $conversation->acheteur_id
            || $user->id === $conversation->vendeur_id;
    }

}

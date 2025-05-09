<?php

namespace App\Policies;

use App\Models\Message;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class MessagePolicy
{

    // Avant toute vérification, si l'utilisateur est admin, on autorise tout.
    public function before(User $user, $ability)
    {
        if ($user->role->nom === 'admin') {
            return true;
        }
    }


    // 1. index (viewAny) : tout utilisateur authentifié peut lister ses messages (le front filtrera par conversation).
    public function viewAny(User $user): bool
    {
        return true;
    }


    // 2. store (create) : tout utilisateur authentifié peut envoyer un message (le FormRequest vérifie qu'il appartient bien à la conversation).
    public function create(User $user): bool
    {
        return true;
    }


    // 3. show (view) : un utilisateur peut voir un message s'il en est l'expéditeur ou qu'il participe à la conversation.
    public function view(User $user, Message $message): bool
    {
        $conv = $message->conversation;
        return $user->id === $message->user_id
            || $user->id === $conv->acheteur_id
            || $user->id === $conv->vendeur_id;
    }


    // 4. update : un utilisateur ne peut modifier que les messages qu'il a envoyés.
    public function update(User $user, Message $message): bool
    {
        return $user->id === $message->user_id;
    }


    // 5. destroy : idem, seul l'expéditeur peut supprimer son message.
    public function delete(User $user, Message $message): bool
    {
        return $user->id === $message->user_id;
    }

}

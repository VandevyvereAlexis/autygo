<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Conversation;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use App\Http\Requests\StoreConversationRequest;
use App\Http\Requests\UpdateConversationRequest;

class ConversationController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth:sanctum');
    }


    // 1. Liste toutes les conversations
    public function index(): JsonResponse
    {
        $convs = Conversation::with(['annonce', 'acheteur', 'vendeur'])->get();
        return response()->json($convs);
    }


    // 2. Crée une conversation
    public function store(StoreConversationRequest $req): JsonResponse
    {
        $conv = Conversation::create($req->validated());
        return response()->json($conv->load(['annonce','acheteur','vendeur']), 201);
    }


    // 3. Montre une conversation
    public function show(Conversation $conversation): JsonResponse
    {
        return response()->json($conversation->load(['annonce','acheteur','vendeur']));
    }


    // 4. Met à jour
    public function update(UpdateConversationRequest $req, Conversation $conversation): JsonResponse
    {
        $conversation->update($req->validated());
        return response()->json($conversation->load(['annonce','acheteur','vendeur']));
    }


    // 5. Supprime
    public function destroy(Conversation $conversation): JsonResponse
    {
        $conversation->delete();
        return response()->json(null, 204);
    }

}

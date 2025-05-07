<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Message;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use App\Http\Requests\StoreMessageRequest;
use App\Http\Requests\UpdateMessageRequest;

class MessageController extends Controller
{

    public function __construct()
    {
        // Seules les méthodes index() et show() restent publiques
        $this->middleware('auth:sanctum');
    }


    // 1. Liste tous les messages (généralement limité à une conversation côté front)
    public function index(): JsonResponse
    {
        $msgs = Message::with(['conversation','user'])->get();
        return response()->json($msgs);
    }


    // 2. Crée un message
    public function store(StoreMessageRequest $req): JsonResponse
    {
        $msg = Message::create($req->validated());
        return response()->json($msg->load(['conversation','user']), 201);
    }


    // 3. Montre un message
    public function show(Message $message): JsonResponse
    {
        return response()->json($message->load(['conversation','user']));
    }


    // 4. Met à jour un message
    public function update(UpdateMessageRequest $req, Message $message): JsonResponse
    {
        $message->update($req->validated());
        return response()->json($message->load(['conversation','user']));
    }


    // 5. Supprime un message
    public function destroy(Message $message): JsonResponse
    {
        $message->delete();
        return response()->json(null, 204);
    }

}

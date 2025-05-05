<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreAvisRequest;
use App\Http\Requests\UpdateAvisRequest;
use App\Models\Avis;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class AvisController extends Controller
{

    // 1. Lister tous les avis
    public function index(): JsonResponse
    {
        $avis = Avis::with(['acheteur', 'vendeur'])->get();
        return response()->json($avis);
    }


    // 2. Créer un nouvel avis
    public function store(StoreAvisRequest $request): JsonResponse
    {
        $avis = Avis::create($request->validated());
        return response()->json($avis->load(['acheteur', 'vendeur']), 201);
    }


    // 3. Afficher un avis spécifique
    public function show($id): JsonResponse
    {
        $avis = Avis::with(['acheteur', 'vendeur'])->findOrFail($id);
        return response()->json($avis);
    }


    // 4. Mettre à jour un avis
    public function update(UpdateAvisRequest $request, Avis $avis): JsonResponse
    {
        $avis->update($request->validated());
        return response()->json($avis->load(['acheteur', 'vendeur']));
    }


    // 5. Supprimer un avis
    public function destroy(Avis $avis): JsonResponse
    {
        $avis->delete();
        return response()->json(null, 204);
    }

}

<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Favoris;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use App\Http\Requests\StoreFavorisRequest;
use App\Http\Requests\UpdateFavorisRequest;

class FavorisController extends Controller
{

    public function __construct()
    {
        // Seules les méthodes index() et show() restent publiques
        $this->middleware('auth:sanctum');
    }

    // 1. Lister tous les favoris
    public function index(): JsonResponse
    {
        $favoris = Favoris::with(['user', 'annonce'])->get();
        return response()->json($favoris);
    }


    // 2. Ajouter un favori
    public function store(StoreFavorisRequest $request): JsonResponse
    {
        $favori = Favoris::create($request->validated());
        return response()->json($favori->load(['user', 'annonce']), 201);
    }


    // 3. Afficher un favori spécifique
    public function show(Favoris $favoris): JsonResponse
    {
        return response()->json($favoris->load(['user', 'annonce']));
    }


    // 4. Mettre à jour un favori
    public function update(UpdateFavorisRequest $request, Favoris $favoris): JsonResponse
    {
        $favoris->update($request->validated());
        return response()->json($favoris->load(['user', 'annonce']));
    }


    // 5. Supprimer un favori
    public function destroy(Favoris $favoris): JsonResponse
    {
        $favoris->delete();
        return response()->json(null, 204);
    }

}

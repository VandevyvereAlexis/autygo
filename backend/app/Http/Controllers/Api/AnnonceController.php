<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Annonce;
use Illuminate\Http\Request;
use App\Http\Requests\StoreAnnonceRequest;
use App\Http\Requests\UpdateAnnonceRequest;
use Illuminate\Http\JsonResponse;

class AnnonceController extends Controller
{

    public function __construct()
    {
        // Seules index() et show() restent publiques
        $this->middleware('auth:sanctum')
             ->except(['index', 'show']);
    }


    // 1. Lister toutes les annonces
    public function index(): JsonResponse
    {
        $annonces = Annonce::with([
            'user', 'marque', 'modele', 'energie', 'transmission',
            'type', 'porte', 'place', 'couleur', 'condition', 'images'
        ])->get();

        return response()->json($annonces);
    }


    // 2. Créer une nouvelle annonce
    public function store(StoreAnnonceRequest $request): JsonResponse
    {
        $annonce = Annonce::create($request->validated());
        return response()->json(
            $annonce->load([
                'user', 'marque', 'modele', 'energie', 'transmission',
                'type', 'porte', 'place', 'couleur', 'condition', 'images'
            ]),
            201
        );
    }


    // 3. Afficher une annonce spécifique
    public function show(Annonce $annonce): JsonResponse
    {
        return response()->json(
            $annonce->load([
                'user', 'marque', 'modele', 'energie', 'transmission',
                'type', 'porte', 'place', 'couleur', 'condition', 'images'
            ])
        );
    }


    // 4. Mettre à jour une annonce
    public function update(UpdateAnnonceRequest $request, Annonce $annonce): JsonResponse
    {
        $annonce->update($request->validated());
        return response()->json(
            $annonce->load([
                'user', 'marque', 'modele', 'energie', 'transmission',
                'type', 'porte', 'place', 'couleur', 'condition', 'images'
            ])
        );
    }


    // 5. Supprimer une annonce
    public function destroy(Annonce $annonce): JsonResponse
    {
        $annonce->delete();
        return response()->json(null, 204);
    }

}

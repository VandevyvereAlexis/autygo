<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreCouleurRequest;
use App\Http\Requests\UpdateCouleurRequest;
use App\Models\Couleur;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class CouleurController extends Controller
{

    public function __construct()
    {
        // Pas d'auth ni de policy sur index/show (publics)
        $this->middleware('auth:sanctum')
            ->except(['index', 'show']);

        // Liaison automatique create/update/delete à la policy
        $this->authorizeResource(
            Couleur::class,
            'couleur',
            ['except' => ['index', 'show']]
        );
    }


    // 1. Lister toutes les couleurs
    public function index(): JsonResponse
    {
        $couleurs = Couleur::all();
        return response()->json($couleurs);
    }


    // 2. Créer une nouvelle couleur
    public function store(StoreCouleurRequest $request): JsonResponse
    {
        $couleur = Couleur::create($request->validated());
        return response()->json($couleur, 201);
    }


    // 3. Afficher une couleur spécifique
    public function show(Couleur $couleur): JsonResponse
    {
        return response()->json($couleur);
    }


    // 4. Mettre à jour une couleur
    public function update(UpdateCouleurRequest $request, Couleur $couleur): JsonResponse
    {
        $couleur->update($request->validated());
        return response()->json($couleur);
    }


    // 5. Supprimer une couleur
    public function destroy(Couleur $couleur): JsonResponse
    {
        $couleur->delete();
        return response()->json(null, 204);
    }

}

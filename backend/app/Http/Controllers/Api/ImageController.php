<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Image;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\StoreImageRequest;
use App\Http\Requests\UpdateImageRequest;

class ImageController extends Controller
{

    public function __construct()
    {
        // Pas d'auth ni de policy sur index/show (publics)
        $this->middleware('auth:sanctum')
            ->except(['index', 'show']);

        // Policy appliquée sur store/update/destroy
        $this->authorizeResource(
            Image::class,
            'image',
            ['except' => ['index', 'show']]
        );
    }



    // 1. Lister toutes les images
    public function index(): JsonResponse
    {
        $images = Image::with('annonce')->get();
        return response()->json($images);
    }



    // 2. Créer un lot d’images (3 à 6) pour une annonce
    public function store(StoreImageRequest $request): JsonResponse
    {
        $data     = $request->validated();
        $created  = [];

        foreach ($data['images'] as $img) {
            // Stocker le fichier et récupérer le chemin
            $path = $img['file']->store("annonces/{$data['annonce_id']}", 'public');

            $created[] = Image::create([
                'path'       => $path,
                'position'   => $img['position'],
                'annonce_id' => $data['annonce_id'],
            ]);
        }

        // Charger la relation annonce
        $created = array_map(fn($img) => $img->load('annonce'), $created);

        return response()->json($created, 201);
    }



    // 3. Afficher une image spécifique
    public function show(Image $image): JsonResponse
    {
        return response()->json($image->load('annonce'));
    }



    // 4. Mettre à jour une image (fichier et/ou position)
    public function update(UpdateImageRequest $request, Image $image): JsonResponse
    {
        $data = $request->validated();

        // Si un nouveau fichier est fourni, supprimer l'ancien et stocker le nouveau
        if ($request->hasFile('file')) {
            Storage::disk('public')->delete($image->path);
            $data['path'] = $request->file('file')->store("annonces/{$data['annonce_id']}", 'public');
        }

        $image->update([
            'path'       => $data['path'] ?? $image->path,
            'position'   => $data['position'],
            'annonce_id' => $data['annonce_id'],
        ]);

        return response()->json($image->load('annonce'));
    }



    // 5. Supprimer une image
    public function destroy(Image $image): JsonResponse
    {
        Storage::disk('public')->delete($image->path);
        $image->delete();

        return response()->json(null, 204);
    }

}

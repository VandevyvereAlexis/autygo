<?php

use App\Http\Controllers\Api\AnnonceController;
use App\Http\Controllers\Api\AvisController;
use App\Http\Controllers\Api\ConditionController;
use App\Http\Controllers\Api\CouleurController;
use App\Http\Controllers\Api\EnergieController;
use App\Http\Controllers\Api\FavorisController;
use App\Http\Controllers\Api\ImageController;
use App\Http\Controllers\Api\MarqueController;
use App\Http\Controllers\Api\ModeleController;
use App\Http\Controllers\Api\PlaceController;
use App\Http\Controllers\Api\PorteController;
use App\Http\Controllers\Api\RoleController;
use App\Http\Controllers\Api\TransmissionController;
use App\Http\Controllers\Api\TypeController;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Api\ConversationController;
use App\Http\Controllers\Api\MessageController;
use App\Http\Controllers\Auth\RegisterController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::apiResource('roles', RoleController::class);
Route::apiResource('marques', MarqueController::class);
Route::apiResource('modeles', ModeleController::class);
Route::apiResource('energies', EnergieController::class)->parameters(['energies' => 'energie']);
Route::apiResource('transmissions', TransmissionController::class);
Route::apiResource('types', TypeController::class);
Route::apiResource('portes', PorteController::class);
Route::apiResource('places', PlaceController::class);
Route::apiResource('couleurs', CouleurController::class);
Route::apiResource('conditions', ConditionController::class);
Route::apiResource('users', UserController::class);
Route::put('users/{user}/password', [UserController::class, 'changePassword']);
Route::apiResource('avis', AvisController::class)->parameters(['avis' => 'avis']);
Route::apiResource('annonces', AnnonceController::class);
Route::apiResource('images', ImageController::class);
Route::apiResource('favoris', FavorisController::class)->parameters(['favoris' => 'favoris']);
Route::apiResource('conversations', ConversationController::class);
Route::apiResource('messages', MessageController::class);
Route::apiResource('conversations', ConversationController::class);
Route::apiResource('messages', MessageController::class);
Route::post('/register', [RegisterController::class, 'register']);


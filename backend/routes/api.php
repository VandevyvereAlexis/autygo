<?php

use App\Http\Controllers\Api\ConditionController;
use App\Http\Controllers\Api\CouleurController;
use App\Http\Controllers\Api\EnergieController;
use App\Http\Controllers\Api\MarqueController;
use App\Http\Controllers\Api\ModeleController;
use App\Http\Controllers\Api\PlaceController;
use App\Http\Controllers\Api\PorteController;
use App\Http\Controllers\Api\RoleController;
use App\Http\Controllers\Api\TransmissionController;
use App\Http\Controllers\Api\TypeController;
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

<?php

use App\Http\Controllers\Auth\LoginController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

// Groupe pour les visiteurs non authentifiés (guest), avec limitation de débit
Route::middleware(['web', 'guest', 'throttle:login'])->group(function () {
    Route::post('/login',  [LoginController::class, 'login'])
         ->name('login');
});

// Groupe pour les utilisateurs authentifiés
Route::middleware(['web', 'auth'])->group(function () {
    // Déconnexion via POST pour respecter le CSRF protection
    Route::post('/logout', [LoginController::class, 'logout'])
         ->name('logout');
});
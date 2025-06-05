<?php

use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\Auth\LoginController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::post('/login',  [LoginController::class, 'login'])->name('login');
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');
Route::get('/me', [LoginController::class, 'me'])->name('me');

Route::post('/password/email', [ForgotPasswordController::class, 'email'])->name('password.email');
Route::post('/password/reset', [ForgotPasswordController::class, 'reset'])->name('password.reset');
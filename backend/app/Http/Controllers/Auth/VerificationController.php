<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Carbon;

class VerificationController extends Controller
{
    public function verify(string $token): JsonResponse
    {
        $user = User::where('email_verification_token', $token)->first();

        if (! $user) {
            return response()->json([
                'error' => 'Token invalide ou déjà utilisé.'
            ], 404);
        }

        $user->email_verified_at        = Carbon::now();
        $user->email_verification_token = null;
        $user->save();

        return response()->json([
            'message' => 'Votre e-mail a bien été vérifié.'
        ]);
    }
}

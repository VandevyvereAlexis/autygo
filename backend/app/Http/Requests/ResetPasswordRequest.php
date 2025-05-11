<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Password;

class ResetPasswordRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'token'                 => 'required|string',
            'email'                 => 'required|email|exists:users,email',
            'password'              => [
                'required',
                'confirmed',
                Password::min(8)
                    ->mixedCase()
                    ->letters()
                    ->numbers()
                    ->symbols(),
            ],
        ];
    }

    public function messages(): array
    {
        return [
            'token.required'                  => 'Le jeton de réinitialisation est manquant.',
            'email.required'                  => "L'adresse e-mail est obligatoire.",
            'email.email'                     => "Le format de l'adresse e-mail est invalide.",
            'email.exists'                    => "Aucun compte n'est associé à cette adresse e-mail.",
            'password.required'               => 'Le nouveau mot de passe est obligatoire.',
            'password.confirmed'              => 'La confirmation du mot de passe ne correspond pas.',
            'password.min'                    => 'Le mot de passe doit contenir au moins 8 caractères.',
            'password.letters'                => 'Le mot de passe doit contenir au moins une lettre.',
            'password.mixed_case'             => 'Le mot de passe doit contenir des majuscules et des minuscules.',
            'password.numbers'                => 'Le mot de passe doit contenir au moins un chiffre.',
            'password.symbols'                => 'Le mot de passe doit contenir au moins un symbole.',
        ];
    }
}

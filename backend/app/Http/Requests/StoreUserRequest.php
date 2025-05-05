<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Password;

class StoreUserRequest extends FormRequest
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
            'nom' => 'required|string|max:60',
            'prenom' => 'required|string|max:60',
            'pseudo' => 'required|string|max:60|unique:users,pseudo',
            'email' => 'required|email|max:100|unique:users,email',
            'image' => 'nullable|image|mimes:jpg,jpeg,png,gif,svg|max:2048',
            'role_id' => 'required|integer|exists:roles,id',
            'password' => [
                'required',
                'confirmed',
                Password::min(8)
                    ->mixedCase()
                    ->letters()
                    ->numbers()
                    ->symbols()
            ],
        ];
    }

    public function messages()
    {
        return [
            // nom
            'nom.required'  => 'Le nom est obligatoire.',
            'nom.string'    => 'Le nom doit être une chaîne de caractères.',
            'nom.max'       => 'Le nom ne peut pas dépasser 60 caractères.',

            // prenom
            'prenom.required' => 'Le prénom est obligatoire.',
            'prenom.string'   => 'Le prénom doit être une chaîne de caractères.',
            'prenom.max'      => 'Le prénom ne peut pas dépasser 60 caractères.',

            // pseudo
            'pseudo.required' => 'Le pseudo est obligatoire.',
            'pseudo.string'   => 'Le pseudo doit être une chaîne de caractères.',
            'pseudo.max'      => 'Le pseudo ne peut pas dépasser 60 caractères.',
            'pseudo.unique'   => 'Ce pseudo est déjà utilisé.',

            // email
            'email.required' => "L'adresse e-mail est obligatoire.",
            'email.email'    => "Le format de l'adresse e-mail est invalide.",
            'email.max'      => "L'adresse e-mail ne peut pas dépasser 100 caractères.",
            'email.unique'   => "Cette adresse e-mail est déjà utilisée.",

            // image
            'image.image'    => 'Le fichier doit être une image.',
            'image.mimes'    => 'Formats autorisés : jpg, jpeg, png, gif, svg.',
            'image.max'      => "L’image ne peut pas dépasser 2 Mo.",

            // role_id
            'role_id.required' => 'Le rôle de l’utilisateur est obligatoire.',
            'role_id.integer'  => 'Le rôle doit être un identifiant numérique.',
            'role_id.exists'   => 'Le rôle sélectionné est invalide.',

            // password
            'password.required'   => 'Le mot de passe est obligatoire.',
            'password.confirmed'  => 'La confirmation du mot de passe ne correspond pas.',
            'password.min'        => 'Le mot de passe doit contenir au moins 8 caractères.',
            'password.letters'    => 'Le mot de passe doit contenir au moins une lettre.',
            'password.mixedCase'  => 'Le mot de passe doit contenir des lettres en minuscules et en majuscules.',
            'password.numbers'    => 'Le mot de passe doit contenir au moins un chiffre.',
            'password.symbols'    => 'Le mot de passe doit contenir au moins un symbole.',
        ];
    }
}

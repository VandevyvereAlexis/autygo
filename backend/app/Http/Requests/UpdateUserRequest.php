<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateUserRequest extends FormRequest
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
        $userId = $this->route('user');

        return [
            'nom'    => ['sometimes', 'required', 'string', 'max:60'],
            'prenom' => ['sometimes', 'required', 'string', 'max:60'],

            'pseudo' => [
                'sometimes', 'string', 'max:60',
                Rule::unique('users', 'pseudo')->ignore($userId),
            ],

            'email' => [
                'sometimes', 'email', 'max:100',
                Rule::unique('users', 'email')->ignore($userId),
            ],

            'image'   => ['nullable', 'image', 'mimes:jpg,jpeg,png,gif,svg', 'max:2048'],
            'role_id' => ['sometimes', 'integer', 'exists:roles,id'],
        ];
    }

    public function messages()
    {
        return [
            // nom
            'nom.required'    => 'Le nom est obligatoire.',
            'nom.string'      => 'Le nom doit être une chaîne de caractères.',
            'nom.max'         => 'Le nom ne peut pas dépasser 60 caractères.',

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
            'email.required'  => "L'adresse e-mail est obligatoire.",
            'email.email'     => "Le format de l'adresse e-mail est invalide.",
            'email.max'       => "L'adresse e-mail ne peut pas dépasser 100 caractères.",
            'email.unique'    => "Cette adresse e-mail est déjà utilisée.",

            // image
            'image.image'     => 'Le fichier doit être une image.',
            'image.mimes'     => 'Formats autorisés : jpg, jpeg, png, gif, svg.',
            'image.max'       => "L’image ne peut pas dépasser 2 Mo.",

            // role_id
            'role_id.required'=> 'Le rôle de l’utilisateur est obligatoire.',
            'role_id.integer' => 'Le rôle doit être un identifiant numérique.',
            'role_id.exists'  => 'Le rôle sélectionné est invalide.',
        ];
    }
}

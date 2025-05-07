<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateProfileRequest extends FormRequest
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
        $userId = $this->user()->id;

        return [
            'nom'     => ['sometimes', 'required', 'string', 'max:60'],
            'prenom'  => ['sometimes', 'required', 'string', 'max:60'],
            'pseudo'  => [
                'sometimes', 'required', 'string', 'max:60',
                Rule::unique('users', 'pseudo')->ignore($userId),
            ],
            'email'   => [
                'sometimes', 'required', 'email', 'max:100',
                Rule::unique('users', 'email')->ignore($userId),
            ],
            'image'   => ['nullable', 'image', 'mimes:jpg,jpeg,png,gif,svg', 'max:2048'],
        ];
    }

    public function messages(): array
    {
        return [
            'nom.required'        => 'Le nom est obligatoire.',
            'nom.string'          => 'Le nom doit être une chaîne de caractères.',
            'nom.max'             => 'Le nom ne peut pas dépasser 60 caractères.',

            'prenom.required'     => 'Le prénom est obligatoire.',
            'prenom.string'       => 'Le prénom doit être une chaîne de caractères.',
            'prenom.max'          => 'Le prénom ne peut pas dépasser 60 caractères.',

            'pseudo.required'     => 'Le pseudo est obligatoire.',
            'pseudo.string'       => 'Le pseudo doit être une chaîne de caractères.',
            'pseudo.max'          => 'Le pseudo ne peut pas dépasser 60 caractères.',
            'pseudo.unique'       => 'Ce pseudo est déjà pris.',

            'email.required'      => "L'adresse e-mail est obligatoire.",
            'email.email'         => "Le format de l'adresse e-mail est invalide.",
            'email.max'           => "L'adresse e-mail ne peut pas dépasser 100 caractères.",
            'email.unique'        => "Cette adresse e-mail est déjà utilisée.",

            'image.image'         => "Le fichier doit être une image.",
            'image.mimes'         => "Le format de l'image doit être jpg, jpeg, png, gif ou svg.",
            'image.max'           => "La taille de l'image ne peut pas dépasser 2 Mo.",
        ];
    }
}

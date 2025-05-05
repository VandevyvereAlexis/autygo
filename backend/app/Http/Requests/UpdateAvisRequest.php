<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateAvisRequest extends FormRequest
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
            'note'        => 'required|integer|between:0,5',
            'commentaire' => 'required|string|max:500',
            'acheteur_id' => 'nullable|integer|exists:users,id',
            'vendeur_id'  => 'required|integer|exists:users,id',
        ];
    }

    public function messages()
    {
        return [
            'note.required'        => 'La note est obligatoire.',
            'note.integer'         => 'La note doit être un nombre entier.',
            'note.between'         => 'La note doit être comprise entre 0 et 5.',
            'commentaire.required' => 'Le commentaire est obligatoire.',
            'commentaire.string'   => 'Le commentaire doit être une chaîne de caractères.',
            'commentaire.max'      => 'Le commentaire ne peut pas dépasser 500 caractères.',
            'acheteur_id.integer'  => "L'identifiant de l’acheteur doit être un nombre entier.",
            'acheteur_id.exists'   => "L’acheteur sélectionné est invalide.",
            'vendeur_id.required'  => 'L’identifiant du vendeur est obligatoire.',
            'vendeur_id.integer'   => 'L’identifiant du vendeur doit être un nombre entier.',
            'vendeur_id.exists'    => 'Le vendeur sélectionné est invalide.',
        ];
    }
}

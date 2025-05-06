<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateAnnonceRequest extends FormRequest
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
    public function rules()
    {
        return [
            'titre'            => 'sometimes|string|max:150',
            'vendu'            => 'sometimes|boolean',
            'visible'          => 'sometimes|boolean',
            'premiere_main'    => 'sometimes|boolean',
            'prix'             => 'sometimes|numeric|min:0',
            'kilometrage'      => 'sometimes|integer|min:0',
            'chevaux_fiscaux'  => 'sometimes|integer|min:0',
            'chevaux_din'      => 'sometimes|integer|min:0',
            'description'      => 'sometimes|string',
            'ville'            => 'sometimes|string|max:100',
            'code_postal'      => 'sometimes|digits:5',
            'latitude'         => 'sometimes|nullable|numeric|between:-90,90',
            'longitude'        => 'sometimes|nullable|numeric|between:-180,180',
            'user_id'          => 'sometimes|integer|exists:users,id',
            'marque_id'        => 'sometimes|integer|exists:marques,id',
            'modele_id'        => 'sometimes|integer|exists:modeles,id',
            'energie_id'       => 'sometimes|integer|exists:energies,id',
            'transmission_id'  => 'sometimes|integer|exists:transmissions,id',
            'type_id'          => 'sometimes|integer|exists:types,id',
            'porte_id'         => 'sometimes|nullable|integer|exists:portes,id',
            'place_id'         => 'sometimes|nullable|integer|exists:places,id',
            'couleur_id'       => 'sometimes|nullable|integer|exists:couleurs,id',
            'condition_id'     => 'sometimes|integer|exists:conditions,id',
        ];
    }

    public function messages()
    {
        return [
            'titre.string'             => 'Le titre doit être une chaîne de caractères.',
            'titre.max'                => 'Le titre ne peut pas dépasser 150 caractères.',

            'vendu.boolean'            => 'Le statut “vendu” doit être vrai ou faux.',

            'visible.boolean'          => 'Le statut “visible” doit être vrai ou faux.',

            'premiere_main.boolean'    => 'Le statut “première main” doit être vrai ou faux.',

            'prix.numeric'             => 'Le prix doit être un nombre.',
            'prix.min'                 => 'Le prix doit être au moins 0.',

            'kilometrage.integer'      => 'Le kilométrage doit être un entier.',
            'kilometrage.min'          => 'Le kilométrage doit être au moins 0.',

            'chevaux_fiscaux.integer'  => 'Le nombre de chevaux fiscaux doit être un entier.',
            'chevaux_fiscaux.min'      => 'Le nombre de chevaux fiscaux doit être au moins 0.',

            'chevaux_din.integer'      => 'Le nombre de chevaux DIN doit être un entier.',
            'chevaux_din.min'          => 'Le nombre de chevaux DIN doit être au moins 0.',

            'description.string'       => 'La description doit être du texte.',

            'ville.string'             => 'La ville doit être une chaîne de caractères.',
            'ville.max'                => 'La ville ne peut pas dépasser 100 caractères.',

            'code_postal.digits'       => 'Le code postal doit contenir exactement 5 chiffres.',

            'latitude.numeric'         => 'La latitude doit être un nombre.',
            'latitude.between'         => 'La latitude doit être comprise entre -90 et 90.',

            'longitude.numeric'        => 'La longitude doit être un nombre.',
            'longitude.between'        => 'La longitude doit être comprise entre -180 et 180.',

            'user_id.integer'          => "L'identifiant de l'utilisateur doit être un entier.",
            'user_id.exists'           => "L'utilisateur sélectionné est invalide.",

            'marque_id.integer'        => "L'identifiant de la marque doit être un entier.",
            'marque_id.exists'         => "La marque sélectionnée est invalide.",

            'modele_id.integer'        => "L'identifiant du modèle doit être un entier.",
            'modele_id.exists'         => "Le modèle sélectionné est invalide.",

            'energie_id.integer'       => "L'identifiant de l'énergie doit être un entier.",
            'energie_id.exists'        => "L'énergie sélectionnée est invalide.",

            'transmission_id.integer'  => "L'identifiant de la transmission doit être un entier.",
            'transmission_id.exists'   => "La transmission sélectionnée est invalide.",

            'type_id.integer'          => "L'identifiant du type doit être un entier.",
            'type_id.exists'           => "Le type sélectionné est invalide.",

            'porte_id.integer'         => "L'identifiant de la porte doit être un entier.",
            'porte_id.exists'          => "La porte sélectionnée est invalide.",

            'place_id.integer'         => "L'identifiant du nombre de places doit être un entier.",
            'place_id.exists'          => "Le nombre de places sélectionné est invalide.",

            'couleur_id.integer'       => "L'identifiant de la couleur doit être un entier.",
            'couleur_id.exists'        => "La couleur sélectionnée est invalide.",

            'condition_id.integer'     => "L'identifiant de la condition doit être un entier.",
            'condition_id.exists'      => "La condition sélectionnée est invalide.",
        ];
    }
}

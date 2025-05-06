<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreAnnonceRequest extends FormRequest
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
            'titre'            => 'required|string|max:150',
            'vendu'            => 'boolean', 'nullable',
            'visible'          => 'boolean', 'nullable',
            'premiere_main'    => 'boolean', 'nullable',
            'prix'             => 'required|numeric|min:0',
            'kilometrage'      => 'required|integer|min:0',
            'chevaux_fiscaux'  => 'required|integer|min:0',
            'chevaux_din'      => 'required|integer|min:0',
            'description'      => 'required|string',
            'ville'            => 'required|string|max:100',
            'code_postal'      => 'required|digits:5',
            'latitude'         => 'nullable|numeric|between:-90,90',
            'longitude'        => 'nullable|numeric|between:-180,180',
            'user_id'          => 'required|integer|exists:users,id',
            'marque_id'        => 'required|integer|exists:marques,id',
            'modele_id'        => 'required|integer|exists:modeles,id',
            'energie_id'       => 'required|integer|exists:energies,id',
            'transmission_id'  => 'required|integer|exists:transmissions,id',
            'type_id'          => 'required|integer|exists:types,id',
            'porte_id'         => 'nullable|integer|exists:portes,id',
            'place_id'         => 'nullable|integer|exists:places,id',
            'couleur_id'       => 'nullable|integer|exists:couleurs,id',
            'condition_id'     => 'required|integer|exists:conditions,id',
        ];
    }

    public function messages()
    {
        return [
            'titre.required'           => 'Le titre est obligatoire.',
            'titre.string'             => 'Le titre doit être une chaîne de caractères.',
            'titre.max'                => 'Le titre ne peut pas dépasser 150 caractères.',

            'vendu.boolean'            => 'Le statut “vendu” doit être vrai ou faux.',
            'vendu.nullable'           => 'Le statut “vendu” peut être laissé vide.',

            'visible.boolean'          => 'Le statut “visible” doit être vrai ou faux.',
            'visible.nullable'         => 'Le statut “visible” peut être laissé vide.',

            'premiere_main.boolean'    => 'Le statut “première main” doit être vrai ou faux.',
            'premiere_main.nullable'   => 'Le statut “première main” peut être laissé vide.',

            'prix.required'            => 'Le prix est obligatoire.',
            'prix.numeric'             => 'Le prix doit être un nombre.',
            'prix.min'                 => 'Le prix doit être au moins 0.',

            'kilometrage.required'     => 'Le kilométrage est obligatoire.',
            'kilometrage.integer'      => 'Le kilométrage doit être un entier.',
            'kilometrage.min'          => 'Le kilométrage doit être au moins 0.',

            'chevaux_fiscaux.required' => 'Le nombre de chevaux fiscaux est obligatoire.',
            'chevaux_fiscaux.integer'  => 'Le nombre de chevaux fiscaux doit être un entier.',
            'chevaux_fiscaux.min'      => 'Le nombre de chevaux fiscaux doit être au moins 0.',

            'chevaux_din.required'     => 'Le nombre de chevaux DIN est obligatoire.',
            'chevaux_din.integer'      => 'Le nombre de chevaux DIN doit être un entier.',
            'chevaux_din.min'          => 'Le nombre de chevaux DIN doit être au moins 0.',

            'description.required'     => 'La description est obligatoire.',
            'description.string'       => 'La description doit être du texte.',

            'ville.required'           => 'La ville est obligatoire.',
            'ville.string'             => 'La ville doit être une chaîne de caractères.',
            'ville.max'                => 'La ville ne peut pas dépasser 100 caractères.',

            'code_postal.required'     => 'Le code postal est obligatoire.',
            'code_postal.digits'       => 'Le code postal doit contenir exactement 5 chiffres.',

            'latitude.numeric'         => 'La latitude doit être un nombre.',
            'latitude.between'         => 'La latitude doit être comprise entre -90 et 90.',
            'latitude.nullable'        => 'La latitude peut être laissée vide.',

            'longitude.numeric'        => 'La longitude doit être un nombre.',
            'longitude.between'        => 'La longitude doit être comprise entre -180 et 180.',
            'longitude.nullable'       => 'La longitude peut être laissée vide.',

            'user_id.required'         => "L'identifiant de l'utilisateur est obligatoire.",
            'user_id.integer'          => "L'identifiant de l'utilisateur doit être un entier.",
            'user_id.exists'           => "L'utilisateur sélectionné est invalide.",

            'marque_id.required'       => "L'identifiant de la marque est obligatoire.",
            'marque_id.integer'        => "L'identifiant de la marque doit être un entier.",
            'marque_id.exists'         => "La marque sélectionnée est invalide.",

            'modele_id.required'       => "L'identifiant du modèle est obligatoire.",
            'modele_id.integer'        => "L'identifiant du modèle doit être un entier.",
            'modele_id.exists'         => "Le modèle sélectionné est invalide.",

            'energie_id.required'      => "L'identifiant de l'énergie est obligatoire.",
            'energie_id.integer'       => "L'identifiant de l'énergie doit être un entier.",
            'energie_id.exists'        => "L'énergie sélectionnée est invalide.",

            'transmission_id.required' => "L'identifiant de la transmission est obligatoire.",
            'transmission_id.integer'  => "L'identifiant de la transmission doit être un entier.",
            'transmission_id.exists'   => "La transmission sélectionnée est invalide.",

            'type_id.required'         => "L'identifiant du type est obligatoire.",
            'type_id.integer'          => "L'identifiant du type doit être un entier.",
            'type_id.exists'           => "Le type sélectionné est invalide.",

            'porte_id.integer'         => "L'identifiant de la porte doit être un entier.",
            'porte_id.exists'          => "La porte sélectionnée est invalide.",
            'porte_id.nullable'        => 'La porte peut être laissée vide.',

            'place_id.integer'         => "L'identifiant du nombre de places doit être un entier.",
            'place_id.exists'          => "Le nombre de places sélectionné est invalide.",
            'place_id.nullable'        => 'Le nombre de places peut être laissé vide.',

            'couleur_id.integer'       => "L'identifiant de la couleur doit être un entier.",
            'couleur_id.exists'        => "La couleur sélectionnée est invalide.",
            'couleur_id.nullable'      => 'La couleur peut être laissée vide.',

            'condition_id.required'    => "L'identifiant de la condition est obligatoire.",
            'condition_id.integer'     => "L'identifiant de la condition doit être un entier.",
            'condition_id.exists'      => "La condition sélectionnée est invalide.",
        ];
    }
}

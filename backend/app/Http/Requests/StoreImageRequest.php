<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreImageRequest extends FormRequest
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
            'annonce_id'            => 'required|integer|exists:annonces,id',
            'images'                => 'required|array|min:3|max:6',
            'images.*.file'         => 'required|image|mimes:jpg,jpeg,png|max:2048',
            'images.*.position'     => 'required|integer|min:1',
        ];
    }

    public function messages()
    {
        return [
            'annonce_id.required'    => "L’identifiant de l’annonce est obligatoire.",
            'annonce_id.exists'      => "L’annonce sélectionnée est invalide.",

            'images.required'        => 'Vous devez fournir un tableau d’images.',
            'images.array'           => 'Le champ images doit être un tableau.',
            'images.min'             => 'Vous devez fournir au moins 3 images.',
            'images.max'             => 'Vous ne pouvez pas fournir plus de 6 images.',

            'images.*.file.required' => 'Chaque image doit être un fichier.',
            'images.*.file.image'    => 'Chaque fichier doit être une image valide.',
            'images.*.file.mimes'    => 'Chaque image doit être au format JPG, JPEG ou PNG.',
            'images.*.file.max'      => 'Chaque image ne peut pas dépasser 2 Mo.',

            'images.*.position.required' => 'La position de chaque image est obligatoire.',
            'images.*.position.integer'  => 'La position de chaque image doit être un entier.',
            'images.*.position.min'      => 'La position de chaque image doit être au moins 1.',
        ];
    }
}

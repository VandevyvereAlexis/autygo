<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateImageRequest extends FormRequest
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
            'file'       => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'position'   => 'required|integer|min:1',
            'annonce_id' => 'required|integer|exists:annonces,id',
        ];
    }

    public function messages()
    {
        return [
            'file.image'    => 'Le fichier doit être une image valide.',
            'file.mimes'    => 'L’image doit être au format JPG, JPEG ou PNG.',
            'file.max'      => 'L’image ne peut pas dépasser 2 Mo.',

            'position.required'   => 'La position est obligatoire.',
            'position.integer'    => 'La position doit être un entier.',
            'position.min'        => 'La position doit être au moins 1.',

            'annonce_id.required' => 'L’identifiant de l’annonce est obligatoire.',
            'annonce_id.exists'   => 'L’annonce sélectionnée est invalide.',
        ];
    }
}

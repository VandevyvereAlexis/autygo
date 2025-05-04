<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreCouleurRequest extends FormRequest
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
            'nom' => 'required|string|max:50|unique:couleurs,nom',
        ];
    }

    public function messages()
    {
        return [
            'nom.required' => 'Le nom de la couleur est obligatoire.',
            'nom.string'   => 'Le nom de la couleur doit être une chaîne de caractères.',
            'nom.max'      => 'Le nom de la couleur ne peut pas dépasser 50 caractères.',
            'nom.unique'   => 'Cette couleur existe déjà.',
        ];
    }
}

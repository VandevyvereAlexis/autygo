<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StorePorteRequest extends FormRequest
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
            'nom' => 'required|string|max:50|unique:portes,nom',
        ];
    }

    public function messages()
    {
        return [
            'nom.required' => 'Le nom de la porte est obligatoire.',
            'nom.string'   => 'Le nom de la porte doit être une chaîne de caractères.',
            'nom.max'      => 'Le nom de la porte ne peut pas dépasser 50 caractères.',
            'nom.unique'   => 'Cette porte existe déjà.',
        ];
    }
}

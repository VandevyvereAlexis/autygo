<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreMarqueRequest extends FormRequest
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
            'nom' => 'required|string|max:50|unique:marques,nom',
        ];
    }

    public function messages()
    {
        return [
            'nom.required' => 'Le nom de la marque est obligatoire.',
            'nom.string'   => 'Le nom de la marque doit être une chaîne de caractères.',
            'nom.max'      => 'Le nom de la marque ne peut pas dépasser 50 caractères.',
            'nom.unique'   => 'Cette marque existe déjà.',
        ];
    }
}

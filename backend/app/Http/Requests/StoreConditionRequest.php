<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreConditionRequest extends FormRequest
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
            'nom' => 'required|string|max:50|unique:conditions,nom',
        ];
    }

    public function messages()
    {
        return [
            'nom.required' => 'Le nom de la condition est obligatoire.',
            'nom.string'   => 'Le nom de la condition doit être une chaîne de caractères.',
            'nom.max'      => 'Le nom de la condition ne peut pas dépasser 50 caractères.',
            'nom.unique'   => 'Cette condition existe déjà.',
        ];
    }
}

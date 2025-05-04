<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StorePlaceRequest extends FormRequest
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
            'nom' => 'required|string|max:50|unique:places,nom',
        ];
    }

    public function messages()
    {
        return [
            'nom.required' => 'Le nom du nombre de places est obligatoire.',
            'nom.string'   => 'Le nombre de places doit être une chaîne de caractères.',
            'nom.max'      => 'Le nombre de places ne peut pas dépasser 50 caractères.',
            'nom.unique'   => 'Ce nombre de places existe déjà.',
        ];
    }
}

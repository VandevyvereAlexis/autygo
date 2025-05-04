<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateTypeRequest extends FormRequest
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
        $typeId = $this->route('type')->getKey();

        return [
            'nom' => [
                'required',
                'string',
                'max:50',
                // on ignore l'enregistrement courant pour l'unicité
                Rule::unique('types', 'nom')->ignore($typeId),
            ],
        ];
    }

    public function messages()
    {
        return [
            'nom.required' => 'Le nom du type est obligatoire.',
            'nom.string'   => 'Le nom du type doit être une chaîne de caractères.',
            'nom.max'      => 'Le nom du type ne peut pas dépasser 50 caractères.',
            'nom.unique'   => 'Ce nom de type est déjà utilisé.',
        ];
    }
}

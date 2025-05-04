<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateEnergieRequest extends FormRequest
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
        $energieId = $this->route('energie')->id;

        return [
            'nom' => [
                'required',
                'string',
                'max:50',
                // on ignore l'enregistrement courant
                Rule::unique('energies', 'nom')->ignore($energieId),
            ],
        ];
    }

    public function messages()
    {
        return [
            'nom.required' => 'Le nom de l’énergie est obligatoire.',
            'nom.string'   => 'Le nom de l’énergie doit être une chaîne de caractères.',
            'nom.max'      => 'Le nom de l’énergie ne peut pas dépasser 50 caractères.',
            'nom.unique'   => 'Ce nom d’énergie est déjà utilisé.',
        ];
    }
}

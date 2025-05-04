<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateCouleurRequest extends FormRequest
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
        $couleurId = $this->route('couleur')->id;

        return [
            'nom' => [
                'required',
                'string',
                'max:50',
                // La seule chose qui change : on ignore l'enregistrement courant
                Rule::unique('couleurs', 'nom')->ignore($couleurId),
            ],
        ];
    }

    public function messages()
    {
        return [
            'nom.required' => 'Le nom de la couleur est obligatoire.',
            'nom.string'   => 'Le nom de la couleur doit être une chaîne de caractères.',
            'nom.max'      => 'Le nom de la couleur ne peut pas dépasser 50 caractères.',
            'nom.unique'   => 'Ce nom de couleur est déjà utilisé.',
        ];
    }
}

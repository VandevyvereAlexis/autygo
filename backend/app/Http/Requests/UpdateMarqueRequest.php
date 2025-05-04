<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateMarqueRequest extends FormRequest
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
        // Avec route-model-binding, on reçoit l'instance Marque
        $marque = $this->route('marque');
        $id = $marque instanceof \App\Models\Marque ? $marque->id : $marque;

        return [
            'nom' => [
                'required',
                'string',
                'max:50',
                // ignore la marque courante pour l'unicité
                Rule::unique('marques', 'nom')->ignore($id),
            ],
        ];
    }

    public function messages()
    {
        return [
            'nom.required' => 'Le nom de la marque est obligatoire.',
            'nom.string'   => 'Le nom de la marque doit être une chaîne de caractères.',
            'nom.max'      => 'Le nom de la marque ne peut pas dépasser 50 caractères.',
            'nom.unique'   => 'Ce nom de marque est déjà utilisé.',
        ];
    }
}

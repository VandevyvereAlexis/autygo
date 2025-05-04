<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateModeleRequest extends FormRequest
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
            'nom'       => 'required|string|max:50',
            'marque_id' => 'required|integer|exists:marques,id',
        ];
    }


    public function withValidator($validator)
    {
        $validator->after(function ($validator) {
            $modeleId = $this->route('modele');
            if ($this->nom && $this->marque_id) {
                $exists = \App\Models\Modele::where('nom', $this->nom)
                            ->where('marque_id', $this->marque_id)
                            ->where('id', '!=', $modeleId)
                            ->exists();
                if ($exists) {
                    $validator->errors()->add(
                        'nom',
                        "Un autre modèle « {$this->nom} » existe déjà pour cette marque."
                    );
                }
            }
        });
    }


    public function messages()
    {
        return [
            'nom.required'       => 'Le nom du modèle est obligatoire.',
            'nom.string'         => 'Le nom du modèle doit être une chaîne de caractères.',
            'nom.max'            => 'Le nom du modèle ne peut pas dépasser 50 caractères.',
            'marque_id.required' => 'L’identifiant de la marque est obligatoire.',
            'marque_id.integer'  => 'L’identifiant de la marque doit être un entier.',
            'marque_id.exists'   => 'La marque sélectionnée est invalide.',
        ];
    }
}

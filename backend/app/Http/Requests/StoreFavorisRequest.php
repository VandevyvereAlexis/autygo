<?php

namespace App\Http\Requests;

use App\Models\Favoris;
use Illuminate\Foundation\Http\FormRequest;

class StoreFavorisRequest extends FormRequest
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
            'user_id'    => 'required|integer|exists:users,id',
            'annonce_id' => 'required|integer|exists:annonces,id',
        ];
    }

    public function withValidator($validator)
    {
        // Vérification manuelle de l'unicité du couple user_id/annonce_id
        $validator->after(function ($validator) {
            if ($this->user_id && $this->annonce_id) {
                $exists = Favoris::where('user_id', $this->user_id)
                                 ->where('annonce_id', $this->annonce_id)
                                 ->exists();
                if ($exists) {
                    $validator->errors()->add(
                        'annonce_id',
                        "L'annonce #{$this->annonce_id} est déjà en favori pour l'utilisateur #{$this->user_id}."
                    );
                }
            }
        });
    }

    public function messages()
    {
        return [
            'user_id.required'    => "L'identifiant de l'utilisateur est obligatoire.",
            'user_id.integer'     => "L'identifiant de l'utilisateur doit être un nombre entier.",
            'user_id.exists'      => "L'utilisateur sélectionné est invalide.",

            'annonce_id.required' => "L'identifiant de l'annonce est obligatoire.",
            'annonce_id.integer'  => "L'identifiant de l'annonce doit être un nombre entier.",
            'annonce_id.exists'   => "L'annonce sélectionnée est invalide.",
        ];
    }
}

<?php

namespace App\Http\Requests;

use App\Models\Favoris;
use Illuminate\Foundation\Http\FormRequest;

class UpdateFavorisRequest extends FormRequest
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
        $validator->after(function ($validator) {
            $favorisId = $this->route('favoris');
            if ($this->user_id && $this->annonce_id) {
                $exists = Favoris::where('user_id', $this->user_id)
                                 ->where('annonce_id', $this->annonce_id)
                                 ->where('id', '!=', $favorisId)
                                 ->exists();
                if ($exists) {
                    $validator->errors()->add(
                        'annonce_id',
                        "Un favori pour l'annonce #{$this->annonce_id} existe déjà pour l'utilisateur #{$this->user_id}."
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

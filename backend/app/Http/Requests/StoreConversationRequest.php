<?php

namespace App\Http\Requests;

use App\Models\Annonce;
use App\Models\Conversation;
use Illuminate\Foundation\Http\FormRequest;

class StoreConversationRequest extends FormRequest
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
            'annonce_id'   => 'required|integer|exists:annonces,id',
            'acheteur_id'  => 'required|integer|exists:users,id',
            'vendeur_id'   => 'required|integer|exists:users,id',
        ];
    }

    public function withValidator($validator)
    {
        $validator->after(function ($validator) {
            $a   = $this->acheteur_id;
            $v   = $this->vendeur_id;
            $ann = Annonce::find($this->annonce_id);

            // 1. Pas de conversation avec soi-même
            if ($a === $v) {
                $validator->errors()->add('acheteur_id', 'Vous ne pouvez pas démarrer une conversation avec vous-même.');
            }

            // 2. Le vendeur doit être bien le propriétaire de l’annonce
            if ($ann && $ann->user_id !== $v) {
                $validator->errors()->add('vendeur_id', 'Le vendeur spécifié n’est pas celui de cette annonce.');
            }

            // 3. Unique par (acheteur, vendeur, annonce)
            $exists = Conversation::where('acheteur_id', $a)
                ->where('vendeur_id', $v)
                ->where('annonce_id', $this->annonce_id)
                ->exists();

            if ($exists) {
                $validator->errors()->add('annonce_id', 'Vous avez déjà démarré une conversation pour cette annonce.');
            }
        });
    }

    public function messages()
    {
        return [
            'annonce_id.required'  => 'L’identifiant de l’annonce est obligatoire.',
            'annonce_id.integer'   => 'L’identifiant de l’annonce doit être un entier.',
            'annonce_id.exists'    => 'L’annonce sélectionnée est invalide.',

            'acheteur_id.required' => 'L’identifiant de l’acheteur est obligatoire.',
            'acheteur_id.integer'  => 'L’identifiant de l’acheteur doit être un entier.',
            'acheteur_id.exists'   => 'L’acheteur sélectionné est invalide.',

            'vendeur_id.required'  => 'L’identifiant du vendeur est obligatoire.',
            'vendeur_id.integer'   => 'L’identifiant du vendeur doit être un entier.',
            'vendeur_id.exists'    => 'Le vendeur sélectionné est invalide.',
        ];
    }
}

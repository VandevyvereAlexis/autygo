<?php

namespace App\Http\Requests;

use App\Models\Conversation;
use Illuminate\Foundation\Http\FormRequest;

class StoreMessageRequest extends FormRequest
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
            'conversation_id' => 'required|integer|exists:conversations,id',
            'user_id'         => 'required|integer|exists:users,id',
            'content'         => 'required|string',
        ];
    }

    public function withValidator($validator)
    {
        $validator->after(function ($validator) {
            $conv = Conversation::find($this->conversation_id);
            if ($conv) {
                // Ne laisser écrire que l’acheteur ou le vendeur
                if (! in_array($this->user_id, [$conv->acheteur_id, $conv->vendeur_id], true)) {
                    $validator->errors()->add('user_id', 'Vous ne faites pas partie de cette conversation.');
                }
            }
        });
    }

    public function messages()
    {
        return [
            'conversation_id.required' => 'L’identifiant de la conversation est obligatoire.',
            'conversation_id.integer'  => 'L’identifiant de la conversation doit être un entier.',
            'conversation_id.exists'   => 'La conversation sélectionnée est invalide.',
            'user_id.required'         => 'L’identifiant de l’utilisateur est obligatoire.',
            'user_id.integer'          => 'L’identifiant de l’utilisateur doit être un entier.',
            'user_id.exists'           => 'L’utilisateur sélectionné est invalide.',
            'content.required'         => 'Le contenu du message est obligatoire.',
            'content.string'           => 'Le contenu du message doit être du texte.',
        ];
    }
}

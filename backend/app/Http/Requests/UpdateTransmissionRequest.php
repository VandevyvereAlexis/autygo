<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateTransmissionRequest extends FormRequest
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
        $transmissionId = $this->route('transmission')->id;

        return [
            'nom' => [
                'required',
                'string',
                'max:50',
                // On ignore l'enregistrement courant sur la clé primaire "id"
                Rule::unique('transmissions', 'nom')->ignore($transmissionId, 'id'),
            ],
        ];
    }

    public function messages()
    {
        return [
            'nom.required' => 'Le nom de la transmission est obligatoire.',
            'nom.string'   => 'Le nom de la transmission doit être une chaîne de caractères.',
            'nom.max'      => 'Le nom de la transmission ne peut pas dépasser 50 caractères.',
            'nom.unique'   => 'Ce nom de transmission est déjà utilisé.',
        ];
    }
}

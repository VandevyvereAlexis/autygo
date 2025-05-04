<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateConditionRequest extends FormRequest
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
        $condition = $this->route('condition');

        $conditionId = $condition instanceof \App\Models\Condition
            ? $condition->getKey()
            : $condition;

        return [
            'nom' => [
                'required',
                'string',
                'max:50',
                Rule::unique('conditions', 'nom')->ignore($conditionId),
            ],
        ];
    }

    public function messages()
    {
        return [
            'nom.required' => 'Le nom de la condition est obligatoire.',
            'nom.string'   => 'Le nom de la condition doit être une chaîne de caractères.',
            'nom.max'      => 'Le nom de la condition ne peut pas dépasser 50 caractères.',
            'nom.unique'   => 'Ce nom de condition est déjà utilisé.',
        ];
    }
}

<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateRoleRequest extends FormRequest
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
        $role = $this->route('role');

        return [
            'nom' => [
                'required',
                'string',
                'max:50',
                Rule::unique('roles', 'nom')->ignore($role->id),
            ],
        ];
    }

    public function messages()
    {
        return [
            'nom.required' => 'Le nom du rôle est obligatoire.',
            'nom.string'   => 'Le nom du rôle doit être une chaîne de caractères.',
            'nom.max'      => 'Le nom du rôle ne peut pas dépasser 50 caractères.',
            'nom.unique'   => 'Ce nom de rôle est déjà utilisé par un autre enregistrement.',
        ];
    }
}

<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Password;
use Illuminate\Support\Facades\Hash;

class UpdateProfilePasswordRequest extends FormRequest
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
            'current_password' => ['required', 'string'],
            'password'         => [
                'required',
                'confirmed',
                Password::min(8)
                    ->letters()
                    ->mixedCase()
                    ->numbers()
                    ->symbols(),
            ],
        ];
    }


    public function withValidator($validator)
    {
        $validator->after(function ($validator) {
            if (! Hash::check($this->input('current_password'), $this->user()->password)) {
                $validator->errors()->add('current_password', 'L’ancien mot de passe est incorrect.');
            }
        });
    }


    public function messages(): array
    {
        return [
            'current_password.required' => 'L’ancien mot de passe est obligatoire.',
            'password.required'         => 'Le nouveau mot de passe est obligatoire.',
            'password.confirmed'        => 'La confirmation du mot de passe ne correspond pas.',
            'password.min'              => 'Le mot de passe doit contenir au moins 8 caractères.',
            'password.letters'          => 'Le mot de passe doit contenir au moins une lettre.',
            'password.mixed_case'       => 'Le mot de passe doit contenir des majuscules et des minuscules.',
            'password.numbers'          => 'Le mot de passe doit contenir au moins un chiffre.',
            'password.symbols'          => 'Le mot de passe doit contenir au moins un symbole.',
        ];
    }
}

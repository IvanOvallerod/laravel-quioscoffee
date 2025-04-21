<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rules\Password as PasswordRules;
use Illuminate\Foundation\Http\FormRequest;

class RegistroRequest extends FormRequest
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
        // Reglas de validacion para mantener mas limpio el AuthController
        return [
            'name' => ['required', 'string', 'min:3'],
            'email' => ['required', 'email', 'unique:users,email'],
            'password' => [
                'required',
                'confirmed',
                PasswordRules::min(8)->letters()->symbols()->numbers(),
            ]
        ];
    }

    public function messages(){
        return [
            'name.required' => 'El nombre es obligatorio',
            'name.min' => 'El nombre debe contener al menos 3 caracteres',
            'name.string' => 'El nombre solo debe contener letras',
            'email.required' => 'El email es obligatorio',
            'email.email' => 'El formato de email no es válido',
            'email.unique' => 'El email ya está registrado',
            'password' => 'El password debe contener 8 caracteres, un simbolo y un número',
            'password.confirmed' => 'El password confirmado no coincide',
        ];
    }
}

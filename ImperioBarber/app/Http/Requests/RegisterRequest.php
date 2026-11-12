<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Password;

class RegisterRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email'],
            'telefono' => ['required', 'string', 'regex:/^[0-9]{7,15}$/', 'unique:users,telefono'],
            'password' => ['required', 'confirmed', Password::min(8)->letters()->numbers()],
            'acepta_datos' => ['accepted'],
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'El nombre es obligatorio.',
            'email.required' => 'El correo es obligatorio.',
            'email.email' => 'Ingresa un correo válido.',
            'email.unique' => 'Ya existe una cuenta con este correo.',
            'telefono.required' => 'El teléfono es obligatorio.',
            'telefono.regex' => 'El teléfono solo puede tener números (entre 7 y 15 dígitos).',
            'telefono.unique' => 'Ya existe una cuenta con este teléfono.',
            'password.required' => 'La contraseña es obligatoria.',
            'password.confirmed' => 'Las contraseñas no coinciden.',
            'password.min' => 'La contraseña debe tener al menos 8 caracteres.',
            'password.letters' => 'La contraseña debe incluir al menos una letra.',
            'password.numbers' => 'La contraseña debe incluir al menos un número.',
            'acepta_datos.accepted' => 'Debes autorizar el tratamiento de tus datos personales para registrarte.',
        ];
    }
}

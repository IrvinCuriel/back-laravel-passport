<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class LoginRequest extends FormRequest
{
    /**
     * Determina si el usuario puede realizar esta petición.
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Reglas de validación.
     */
    public function rules()
    {
        return [
            'email' => 'required|email',
            'password' => 'required|string|min:6'
        ];
    }

    /**
     * Mensajes personalizados.
     */
    public function messages()
    {
        return [
            'email.required'    => 'El correo es obligatorio.',
            'email.email'       => 'Debe proporcionar un correo válido.',
            'password.required' => 'La contraseña es obligatoria.',
            'password.min'      => 'La contraseña debe tener al menos 6 caracteres.'
        ];
    }
}
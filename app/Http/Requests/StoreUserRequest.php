<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreUserRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'first_name' => 'required|string|max:100',
            'last_name' => 'required|string|max:100',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:8|confirmed',
        ];
    }

    public function messages()
    {
        return [

            'first_name.required' => 'El nombre es obligatorio.',

            'last_name.required' => 'El apellido es obligatorio.',

            'email.required' => 'El correo es obligatorio.',

            'email.email' => 'Debe ingresar un correo válido.',

            'email.unique' => 'El correo ya está registrado.',

            'password.required' => 'La contraseña es obligatoria.',

            'password.min' => 'Debe tener mínimo 8 caracteres.',

            'password.confirmed' => 'Las contraseñas no coinciden.',
        ];
    }
}
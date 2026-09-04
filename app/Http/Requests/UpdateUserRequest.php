<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateUserRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        $user = $this->route('usuario');

        if (!$user) {
            $user = $this->route('id');
        }

        return [

            'first_name' => 'required|string|max:100',

            'last_name' => 'required|string|max:100',

            'email' => [
                'required',
                'email',
                \Illuminate\Validation\Rule::unique('users')->ignore($user)
            ],

            'password' => 'nullable|string|min:8|confirmed'

        ];
    }

    public function messages()
    {
        return [

            'first_name.required' => 'El nombre es obligatorio.',
            
            'last_name.required' => 'El nombre es obligatorio.',

            'email.required' => 'El correo es obligatorio.',

            'email.unique' => 'El correo ya está registrado.',

            'password.confirmed' => 'Las contraseñas no coinciden.'
        ];
    }
}
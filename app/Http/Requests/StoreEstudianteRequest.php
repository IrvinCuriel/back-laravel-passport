<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreEstudianteRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'nombre'   => 'required|string|max:100',
            'apellido' => 'required|string|max:100',
            'foto' => 'nullable|string',
        ];
    }

    public function messages()
    {
        return [

            'nombre.required'   => 'El nombre es obligatorio.',
            'nombre.max'        => 'El nombre no puede exceder 100 caracteres.',

            'apellido.required' => 'El apellido es obligatorio.',
            'apellido.max'      => 'El apellido no puede exceder 100 caracteres.',

            'foto.max'          => 'La foto no puede exceder 255 caracteres.',
        ];
    }
}
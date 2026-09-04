<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateEstudianteRequest extends FormRequest
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

            'apellido.required' => 'El apellido es obligatorio.',

        ];
    }
}
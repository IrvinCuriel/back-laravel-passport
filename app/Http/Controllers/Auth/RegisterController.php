<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | Este controlador maneja el registro de nuevos usuarios.
    |
    */

    use RegistersUsers;

    /**
     * Ruta a la que será redirigido el usuario después del registro.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Crear una nueva instancia del controlador.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Validar los datos enviados desde el formulario.
     *
     * @param array $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make(
            $data,
            [
                'first_name' => [
                    'required',
                    'string',
                    'max:255',
                ],

                'last_name' => [
                    'required',
                    'string',
                    'max:255',
                ],

                'email' => [
                    'required',
                    'string',
                    'email',
                    'max:255',
                    'unique:users',
                ],

                'password' => [
                    'required',
                    'string',
                    'min:8',
                    'confirmed',
                ],
            ],
            [
                'first_name.required' => 'El nombre es obligatorio.',
                'first_name.string' => 'El nombre debe ser texto.',
                'first_name.max' => 'El nombre no debe superar los 255 caracteres.',

                'last_name.required' => 'El apellido es obligatorio.',
                'last_name.string' => 'El apellido debe ser texto.',
                'last_name.max' => 'El apellido no debe superar los 255 caracteres.',

                'email.required' => 'El correo electrónico es obligatorio.',
                'email.email' => 'El correo electrónico no tiene un formato válido.',
                'email.unique' => 'Este correo electrónico ya está registrado.',

                'password.required' => 'La contraseña es obligatoria.',
                'password.min' => 'La contraseña debe contener al menos 8 caracteres.',
                'password.confirmed' => 'La confirmación de la contraseña no coincide.',
            ]
        );
    }

    /**
     * Crear el usuario después de validar los datos.
     *
     * @param array $data
     * @return \App\Models\User
     */
    protected function create(array $data)
    {
        return User::create([
            'first_name' => $data['first_name'],
            'last_name' => $data['last_name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
        ]);
    }
}
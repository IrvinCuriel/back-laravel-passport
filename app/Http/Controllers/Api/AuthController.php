<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use App\Http\Resources\UserResource;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    /**
     * Login de usuario.
     */
    public function login(LoginRequest $request)
    {
        if (!Auth::attempt($request->only('email', 'password'))) {

            return response()->json([
                'success' => false,
                'message' => 'Las credenciales son incorrectas.'
            ], 401);
        }

        $user = Auth::user();

        /*
         * Passport crea un Personal Access Token.
         */
        $tokenResult = $user->createToken('vue-token');

        return response()->json([
            'success'    => true,
            'message'    => 'Inicio de sesión correcto.',
            'token'      => $tokenResult->accessToken,
            'token_type' => 'Bearer',
            'user'       => new UserResource($user)
        ]);
    }

    /**
     * Usuario autenticado.
     */
    public function me(Request $request)
    {
        return response()->json([
            'success' => true,
            'user' => new UserResource($request->user())
        ]);
    }

    /**
     * Logout.
     */
    public function logout(Request $request)
    {
        $token = $request->user()->token();

        if ($token) {
            $token->revoke();
        }

        return response()->json([
            'success' => true,
            'message' => 'Sesión cerrada correctamente.'
        ]);
    }
}
<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Http\Resources\UserResource;
use App\Models\User;
use App\Traits\ApiResponse;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    use ApiResponse;

    /**
     * Listado de usuarios.
     */
    public function index()
    {
        $users = User::all();

        return $this->successResponse(
            UserResource::collection($users),
            'Listado de usuarios.'
        );
    }

    /**
     * Crear usuario.
     */
    public function store(StoreUserRequest $request)
    {
        $data = $request->validated();

        $data['password'] = Hash::make(
            $data['password']
        );

        unset($data['password_confirmation']);

        $user = User::create($data);

        return $this->successResponse(
            new UserResource($user),
            'Usuario creado correctamente.',
            201
        );
    }

    /**
     * Mostrar usuario.
     */
    public function show($id)
    {
        $user = User::find($id);

        if (!$user) {
            return $this->errorResponse(
                'El usuario no existe.',
                404
            );
        }

        return $this->successResponse(
            new UserResource($user),
            'Usuario encontrado.'
        );
    }

    /**
     * Actualizar usuario.
     */
    public function update(
        UpdateUserRequest $request,
        $id
    ) {
        $user = User::find($id);

        if (!$user) {
            return $this->errorResponse(
                'El usuario no existe.',
                404
            );
        }

        $data = $request->validated();

        if (!empty($data['password'])) {

            $data['password'] = Hash::make(
                $data['password']
            );

        } else {

            unset($data['password']);
        }

        unset($data['password_confirmation']);

        $user->update($data);

        return $this->successResponse(
            new UserResource($user),
            'Usuario actualizado correctamente.'
        );
    }

    /**
     * Eliminar usuario.
     */
    public function destroy($id)
    {
        $user = User::find($id);

        if (!$user) {
            return $this->errorResponse(
                'El usuario no existe.',
                404
            );
        }

        $user->delete();

        return $this->successResponse(
            null,
            'Usuario eliminado correctamente.'
        );
    }
}
<?php

namespace App\Http\Controllers;

use App\Models\Estudiante;
use App\Http\Requests\StoreEstudianteRequest;
use App\Http\Requests\UpdateEstudianteRequest;
use App\Traits\ApiResponse;
use App\Http\Resources\EstudianteResource;

class EstudiantesController extends Controller
{
    // Listado de estudiantes.
    public function index()
    {
        $estudiantes = Estudiante::all();

        return $this->successResponse(
            EstudianteResource::collection($estudiantes),
            'Listado de estudiantes.'
        );
    }

    // Crear estudiante.
    public function store(StoreEstudianteRequest $request)
    {
        $estudiante = Estudiante::create(
            $request->validated()
        );

        return $this->successResponse(
            new EstudianteResource($estudiante),
            'Estudiante creado correctamente.',
            201
        );
    }

    // Mostrar estudiante.
    public function show($id)
    {
        $estudiante = Estudiante::with('cursos')->find($id);

        if (!$estudiante) {
            return $this->errorResponse(
                'El estudiante no existe.',
                404
            );
        }

        return $this->successResponse(
            new EstudianteResource($estudiante),
            'Estudiante encontrado.'
        );
    }

    // Actualizar estudiante.
    public function update(
        UpdateEstudianteRequest $request,
        $id
    ) {
        $estudiante = Estudiante::find($id);

        if (!$estudiante) {
            return $this->errorResponse(
                'El estudiante no existe.',
                404
            );
        }

        $estudiante->update(
            $request->validated()
        );

        return $this->successResponse(
            new EstudianteResource($estudiante),
            'Estudiante actualizado correctamente.'
        );
    }

    // Eliminar estudiante.
    public function destroy($id)
    {
        $estudiante = Estudiante::find($id);

        if (!$estudiante) {
            return $this->errorResponse(
                'El estudiante no existe.',
                404
            );
        }

        $estudiante->delete();

        return $this->successResponse(
            null,
            'Estudiante eliminado correctamente.'
        );
    }
}
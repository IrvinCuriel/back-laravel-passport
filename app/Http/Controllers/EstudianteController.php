<?php

namespace App\Http\Controllers;

use App\Models\Estudiante;
use App\Http\Requests\StoreEstudianteRequest;
use App\Http\Requests\UpdateEstudianteRequest;
use Illuminate\Http\Request;

class EstudianteController extends Controller
{
    public function index()
    {
        /*
        $estudiantes = Estudiante::all();
        return response([
            'estudiantes'=> $estudiantes
        ]);
        */

        $estudiantes = Estudiante::all();

        return response()->json([
            'success' => true,
            'message' => 'Listado de estudiantes.',
            'data'    => $estudiantes,
        ]);

    }

    public function store(StoreEstudianteRequest $request)
    {
        $estudiante = Estudiante::create($request->validated());

        return response()->json([
            'success' => true,
            'message' => 'Estudiante creado correctamente.',
            'data' => [
                'id'         => $estudiante->id,
                'nombre'     => $estudiante->nombre,
                'apellido'   => $estudiante->apellido,
                'foto'       => $estudiante->foto,
                'created_at' => optional($estudiante->created_at)->toISOString(),
                'updated_at' => optional($estudiante->updated_at)->toISOString(),
            ]
        ], 201);
    }

    public function show($id)
    {
        $estudiante = Estudiante::find($id);

        if (!$estudiante) {
            return response()->json([
                'success' => false,
                'message' => 'El estudiante no existe.',
                'errors'  => null
            ], 404);
        }

        return response()->json([
            'success' => true,
            'message' => 'Estudiante encontrado.',
            'data' => [
                'id'         => $estudiante->id,
                'nombre'     => $estudiante->nombre,
                'apellido'   => $estudiante->apellido,
                'foto'       => $estudiante->foto,
                'created_at' => optional($estudiante->created_at)->toISOString(),
                'updated_at' => optional($estudiante->updated_at)->toISOString(),
            ]
        ], 200);
    }

    public function update(UpdateEstudianteRequest $request, $id)
    {
        $estudiante = Estudiante::find($id);

        if (!$estudiante) {
            return response()->json([
                'success' => false,
                'message' => 'El estudiante no existe.',
                'errors'  => null
            ], 404);
        }

        $estudiante->update($request->validated());

        return response()->json([
            'success' => true,
            'message' => 'Estudiante actualizado correctamente.',
            'data' => [
                'id'         => $estudiante->id,
                'nombre'     => $estudiante->nombre,
                'apellido'   => $estudiante->apellido,
                'foto'       => $estudiante->foto,
                'created_at' => optional($estudiante->created_at)->toISOString(),
                'updated_at' => optional($estudiante->updated_at)->toISOString(),
            ]
        ], 200);
    }

    public function destroy($id)
    {
        $estudiante = Estudiante::find($id);

        if (!$estudiante) {
            return response()->json([
                'success' => false,
                'message' => 'El estudiante no existe.',
                'errors'  => null
            ], 404);
        }

        $estudiante->delete();

        return response()->json([
            'success' => true,
            'message' => 'Estudiante eliminado correctamente.',
            'data'    => null
        ], 200);
    }


}

<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class EstudianteResource extends JsonResource
{
    /**
     * Transformar el recurso en un arreglo.
     */
    public function toArray($request)
    {
        return [
            'id'         => $this->id,
            'nombre'     => $this->nombre,
            'apellido'   => $this->apellido,
            'foto'       => $this->foto,

            'cursos' => CursoResource::collection(
                $this->whenLoaded('cursos')
            ),

            'created_at' => optional($this->created_at)->toISOString(),
            'updated_at' => optional($this->updated_at)->toISOString(),
        ];
    }
}
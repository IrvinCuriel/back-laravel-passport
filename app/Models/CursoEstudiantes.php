<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Curso_estudiantes extends Model
{
    use HasFactory;

    protected $table = 'curso_estudiante';

    protected $fillable = [
        'curso_id',
        'estudiante_id',
    ];
}
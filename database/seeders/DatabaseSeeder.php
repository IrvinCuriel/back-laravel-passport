<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Estudiante;
use App\Models\Curso;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();
        Estudiante::factory()->times(15)->create();
        Curso::factory()->times(8)->create()->each(
            function($curso){
                $curso->estudiantes()->sync(
                    Estudiante::all()->random(3)
                );
            }
        );
    }
}

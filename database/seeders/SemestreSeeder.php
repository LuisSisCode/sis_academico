<?php

namespace Database\Seeders;

use App\Models\Semestre;
use App\Models\Carrera;
use Illuminate\Database\Seeder;

class SemestreSeeder extends Seeder
{
    public function run(): void
    {
        // Obtener la carrera de Ingeniería de Sistemas
        $carreraSistemas = Carrera::where('codigo_carrera', 'SIS')->first();

        if (!$carreraSistemas) {
            $this->command->error('Carrera de Sistemas no encontrada. Ejecuta CarreraSeeder primero.');
            return;
        }

        $semestres = [
            ['nombre' => 'Primer Semestre', 'numero_semestre' => 1, 'tipo' => 'Regular'],
            ['nombre' => 'Segundo Semestre', 'numero_semestre' => 2, 'tipo' => 'Regular'],
            ['nombre' => 'Tercer Semestre', 'numero_semestre' => 3, 'tipo' => 'Regular'],
            ['nombre' => 'Cuarto Semestre', 'numero_semestre' => 4, 'tipo' => 'Regular'],
            ['nombre' => 'Quinto Semestre', 'numero_semestre' => 5, 'tipo' => 'Regular'],
            ['nombre' => 'Sexto Semestre', 'numero_semestre' => 6, 'tipo' => 'Regular'],
            ['nombre' => 'Séptimo Semestre', 'numero_semestre' => 7, 'tipo' => 'Regular'],
            ['nombre' => 'Octavo Semestre', 'numero_semestre' => 8, 'tipo' => 'Regular'],
            ['nombre' => 'Noveno Semestre', 'numero_semestre' => 9, 'tipo' => 'Regular'],
            ['nombre' => 'Electivas', 'numero_semestre' => 10, 'tipo' => 'Regular'],
            ['nombre' => 'Modalidad de Graduación', 'numero_semestre' => 11, 'tipo' => 'Regular'],
        ];

        foreach ($semestres as $semestre) {
            Semestre::create([
                'ID_carrera' => $carreraSistemas->ID_carrera,
                'nombre' => $semestre['nombre'],
                'numero_semestre' => $semestre['numero_semestre'],
                'tipo' => $semestre['tipo'],
            ]);
        }
    }
}

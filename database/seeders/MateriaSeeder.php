<?php

namespace Database\Seeders;

use App\Models\Materia;
use App\Models\Carrera;
use App\Models\Semestre;
use Illuminate\Database\Seeder;

class MateriaSeeder extends Seeder
{
    public function run(): void
    {
        $carreraSistemas = Carrera::where('codigo_carrera', 'SIS')->first();

        if (!$carreraSistemas) {
            $this->command->error('Carrera de Sistemas no encontrada.');
            return;
        }

        $primerSemestre = Semestre::where('ID_carrera', $carreraSistemas->ID_carrera)
            ->where('numero_semestre', 1)
            ->first();

        $segundoSemestre = Semestre::where('ID_carrera', $carreraSistemas->ID_carrera)
            ->where('numero_semestre', 2)
            ->first();

        if (!$primerSemestre || !$segundoSemestre) {
            $this->command->error('Semestres no encontrados.');
            return;
        }

        $materias = [
            // Primer Semestre
            [
                'ID_carrera' => $carreraSistemas->ID_carrera,
                'ID_semestre' => $primerSemestre->ID_semestre,
                'Nombre' => 'Cálculo I',
                'sigla' => 'MAT101',
                'creditos' => 4,
                'descripcion' => 'Introducción al cálculo diferencial e integral',
                'tiene_auxiliar' => true,
            ],
            [
                'ID_carrera' => $carreraSistemas->ID_carrera,
                'ID_semestre' => $primerSemestre->ID_semestre,
                'Nombre' => 'Álgebra',
                'sigla' => 'MAT102',
                'creditos' => 4,
                'descripcion' => 'Fundamentos de álgebra lineal y matricial',
                'tiene_auxiliar' => true,
            ],
            [
                'ID_carrera' => $carreraSistemas->ID_carrera,
                'ID_semestre' => $primerSemestre->ID_semestre,
                'Nombre' => 'Introducción a la Programación',
                'sigla' => 'INF110',
                'creditos' => 5,
                'descripcion' => 'Fundamentos de programación y algoritmos',
                'tiene_auxiliar' => true,
            ],
            // Segundo Semestre
            [
                'ID_carrera' => $carreraSistemas->ID_carrera,
                'ID_semestre' => $segundoSemestre->ID_semestre,
                'Nombre' => 'Cálculo II',
                'sigla' => 'MAT201',
                'creditos' => 4,
                'descripcion' => 'Cálculo avanzado y ecuaciones diferenciales',
                'tiene_auxiliar' => true,
            ],
            [
                'ID_carrera' => $carreraSistemas->ID_carrera,
                'ID_semestre' => $segundoSemestre->ID_semestre,
                'Nombre' => 'Estructura de Datos',
                'sigla' => 'INF210',
                'creditos' => 5,
                'descripcion' => 'Estructuras de datos y algoritmos avanzados',
                'tiene_auxiliar' => true,
            ],
        ];

        foreach ($materias as $materia) {
            Materia::create($materia);
        }
    }
}

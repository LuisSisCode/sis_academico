<?php

namespace Database\Seeders;

use App\Models\Carrera;
use Illuminate\Database\Seeder;

class CarreraSeeder extends Seeder
{
    public function run(): void
    {
        $carreras = [
            [
                'nombre' => 'Ingeniería de Sistemas',
                'codigo_carrera' => 'SIS',
                'activo' => true,
            ],
            [
                'nombre' => 'Ingeniería Industrial',
                'codigo_carrera' => 'IND',
                'activo' => true,
            ],
            [
                'nombre' => 'Ingeniería Civil',
                'codigo_carrera' => 'CIV',
                'activo' => true,
            ],
        ];

        foreach ($carreras as $carrera) {
            Carrera::create($carrera);
        }
    }
}

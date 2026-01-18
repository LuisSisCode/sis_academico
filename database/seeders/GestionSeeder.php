<?php

namespace Database\Seeders;

use App\Models\Gestion;
use Illuminate\Database\Seeder;

class GestionSeeder extends Seeder
{
    public function run(): void
    {
        $gestiones = [
            [
                'nombre' => '1-2025',
                'numero' => 1,
                'anio' => 2025,
                'es_actual' => false,
                'fecha_inicio' => '2025-02-01',
                'fecha_fin' => '2025-06-30',
            ],
            [
                'nombre' => '2-2025',
                'numero' => 2,
                'anio' => 2025,
                'es_actual' => false,
                'fecha_inicio' => '2025-08-01',
                'fecha_fin' => '2025-12-31',
            ],
            [
                'nombre' => '1-2026',
                'numero' => 1,
                'anio' => 2026,
                'es_actual' => true,
                'fecha_inicio' => '2026-02-01',
                'fecha_fin' => '2026-06-30',
            ],
        ];

        foreach ($gestiones as $gestion) {
            Gestion::create($gestion);
        }
    }
}

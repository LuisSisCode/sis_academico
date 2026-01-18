<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Carrera;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        $carreraSistemas = Carrera::where('codigo_carrera', 'SIS')->first();

        // Super Usuario
        User::create([
            'ID_carrera' => $carreraSistemas?->ID_carrera,
            'nombre' => 'Super Administrador',
            'email' => 'admin@sistemas.edu.bo',
            'password' => Hash::make('password123'),
            'tipo_usuario' => 'Super usuario',
            'email_verified_at' => now(),
        ]);

        // Administrador
        User::create([
            'ID_carrera' => $carreraSistemas?->ID_carrera,
            'nombre' => 'Administrador',
            'email' => 'admin2@sistemas.edu.bo',
            'password' => Hash::make('password123'),
            'tipo_usuario' => 'Admin',
            'email_verified_at' => now(),
        ]);

        // Auxiliar de prueba
        User::create([
            'ID_carrera' => $carreraSistemas?->ID_carrera,
            'nombre' => 'Juan Pérez',
            'email' => 'auxiliar@sistemas.edu.bo',
            'password' => Hash::make('password123'),
            'tipo_usuario' => 'Auxiliar',
            'email_verified_at' => now(),
        ]);
    }
}

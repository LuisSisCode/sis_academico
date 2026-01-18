<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Carrera;
use App\Models\Materia;
use App\Models\Docente;
use App\Models\Auxiliar;
use App\Models\Gestion;
use App\Models\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        // Estadísticas generales
        $stats = [
            'total_carreras' => Carrera::activos()->count(),
            'total_materias' => Materia::count(),
            'total_docentes' => Docente::activos()->count(),
            'total_auxiliares' => Auxiliar::activos()->count(),
            'total_usuarios' => User::count(),
            'gestion_actual' => Gestion::actual()->first(),
        ];

        // Últimas actividades (opcional)
        $ultimasCarreras = Carrera::latest()->take(5)->get();
        $ultimasMaterias = Materia::with(['carrera', 'semestre'])->latest()->take(5)->get();

        return view('admin.dashboard', compact('stats', 'ultimasCarreras', 'ultimasMaterias'));
    }
}

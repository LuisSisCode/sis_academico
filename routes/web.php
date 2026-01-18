<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\CarreraController;
use App\Http\Controllers\Admin\SemestreController;
use App\Http\Controllers\Admin\MateriaController;
use App\Http\Controllers\Admin\DocenteController;
use App\Http\Controllers\Admin\AuxiliarController;
use App\Http\Controllers\Admin\GestionController;
use App\Http\Controllers\Admin\HorarioController;
use App\Http\Controllers\Admin\GrupoWhatsappController;
use Illuminate\Support\Facades\Route;

// Ruta pública de inicio
Route::get('/', function () {
    return view('welcome');
});

// Rutas de autenticación (Breeze)
require __DIR__.'/auth.php';

// Rutas protegidas que requieren autenticación
Route::middleware('auth')->group(function () {

    // ⭐ RUTA DASHBOARD - Redirección simple
    Route::get('/dashboard', function () {
        return redirect('/admin/dashboard');
    })->name('dashboard');

    // Rutas de perfil (accesible para todos los usuarios autenticados)
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Rutas del Panel de Administración (Solo Super usuario y Admin)
    Route::middleware(['role:Super usuario,Admin'])->prefix('admin')->name('admin.')->group(function () {

        // Dashboard Admin
        Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

        // Gestión de Carreras
        Route::resource('carreras', CarreraController::class);

        // Gestión de Semestres
        Route::resource('semestres', SemestreController::class);

        // Gestión de Materias
        Route::resource('materias', MateriaController::class);

        // Gestión de Docentes
        Route::resource('docentes', DocenteController::class);

        // Gestión de Auxiliares
        Route::resource('auxiliares', AuxiliarController::class);

        // Gestión de Gestiones
        Route::resource('gestiones', GestionController::class);
        Route::post('gestiones/{gestion}/marcar-actual', [GestionController::class, 'marcarActual'])
            ->name('gestiones.marcar-actual');

        // Gestión de Horarios
        Route::resource('horarios', HorarioController::class);
        Route::get('horarios/{horario}/descargar', [HorarioController::class, 'descargar'])
            ->name('horarios.descargar');

        // Gestión de Grupos de WhatsApp
        Route::resource('grupos-whatsapp', GrupoWhatsappController::class);
    });
});

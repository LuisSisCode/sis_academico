<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Auxiliar;
use App\Models\Materia;
use App\Models\Carrera;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Hash;

class AuxiliarController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $auxiliares = Auxiliar::with(['materia', 'carrera', 'user'])
            ->latest()
            ->paginate(10);

        return view('admin.auxiliares.index', compact('auxiliares'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $materias = Materia::conAuxiliar()->with('carrera', 'semestre')->get();
        $carreras = Carrera::activos()->get();

        return view('admin.auxiliares.create', compact('materias', 'carreras'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'ID_materia' => 'required|exists:materias,ID_materia',
            'ID_carrera' => 'required|exists:carreras,ID_carrera',
            'nombre' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:8|confirmed',
            'celular' => 'nullable|string|max:255',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'activo' => 'boolean',
        ]);

        // Crear usuario
        $user = User::create([
            'ID_carrera' => $validated['ID_carrera'],
            'nombre' => $validated['nombre'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
            'tipo_usuario' => 'Auxiliar',
        ]);

        // Manejar subida de foto
        $fotoPath = null;
        if ($request->hasFile('foto')) {
            $fotoPath = $request->file('foto')->store('auxiliares', 'public');
        }

        // Crear auxiliar
        Auxiliar::create([
            'ID_materia' => $validated['ID_materia'],
            'ID_carrera' => $validated['ID_carrera'],
            'ID_users' => $user->ID_users,
            'celular' => $validated['celular'],
            'foto' => $fotoPath,
            'activo' => $validated['activo'] ?? true,
        ]);

        return redirect()->route('admin.auxiliares.index')
            ->with('success', 'Auxiliar creado exitosamente.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Auxiliar $auxiliare)
    {
        $auxiliare->load(['materia', 'carrera', 'user', 'materialesAuxiliar']);

        return view('admin.auxiliares.show', compact('auxiliare'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Auxiliar $auxiliare)
    {
        $materias = Materia::conAuxiliar()->with('carrera', 'semestre')->get();
        $carreras = Carrera::activos()->get();

        return view('admin.auxiliares.edit', compact('auxiliare', 'materias', 'carreras'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Auxiliar $auxiliare)
    {
        $validated = $request->validate([
            'ID_materia' => 'required|exists:materias,ID_materia',
            'ID_carrera' => 'required|exists:carreras,ID_carrera',
            'nombre' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $auxiliare->ID_users . ',ID_users',
            'password' => 'nullable|string|min:8|confirmed',
            'celular' => 'nullable|string|max:255',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'activo' => 'boolean',
        ]);

        // Actualizar usuario
        $userData = [
            'ID_carrera' => $validated['ID_carrera'],
            'nombre' => $validated['nombre'],
            'email' => $validated['email'],
        ];

        if ($request->filled('password')) {
            $userData['password'] = Hash::make($validated['password']);
        }

        $auxiliare->user->update($userData);

        // Manejar subida de nueva foto
        if ($request->hasFile('foto')) {
            // Eliminar foto anterior si existe
            if ($auxiliare->foto) {
                Storage::disk('public')->delete($auxiliare->foto);
            }
            $validated['foto'] = $request->file('foto')->store('auxiliares', 'public');
        } else {
            unset($validated['foto']);
        }

        // Actualizar auxiliar
        $auxiliare->update([
            'ID_materia' => $validated['ID_materia'],
            'ID_carrera' => $validated['ID_carrera'],
            'celular' => $validated['celular'],
            'foto' => $validated['foto'] ?? $auxiliare->foto,
            'activo' => $validated['activo'] ?? true,
        ]);

        return redirect()->route('admin.auxiliares.index')
            ->with('success', 'Auxiliar actualizado exitosamente.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Auxiliar $auxiliare)
    {
        // Eliminar foto si existe
        if ($auxiliare->foto) {
            Storage::disk('public')->delete($auxiliare->foto);
        }

        // Eliminar usuario asociado
        $auxiliare->user->delete();

        // Eliminar auxiliar
        $auxiliare->delete();

        return redirect()->route('admin.auxiliares.index')
            ->with('success', 'Auxiliar eliminado exitosamente.');
    }
}

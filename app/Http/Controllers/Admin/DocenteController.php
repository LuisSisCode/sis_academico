<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Docente;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class DocenteController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $docentes = Docente::latest()->paginate(10);

        return view('admin.docentes.index', compact('docentes'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.docentes.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nombre' => 'required|string|max:255',
            'especialidad' => 'nullable|string|max:255',
            'telefono' => 'nullable|string|max:255',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'activo' => 'boolean',
        ]);

        // Manejar subida de foto
        if ($request->hasFile('foto')) {
            $validated['foto'] = $request->file('foto')->store('docentes', 'public');
        }

        Docente::create($validated);

        return redirect()->route('admin.docentes.index')
            ->with('success', 'Docente creado exitosamente.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Docente $docente)
    {
        $docente->load(['docentesCarrera.carrera', 'materiaGestionDocente.materia']);

        return view('admin.docentes.show', compact('docente'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Docente $docente)
    {
        return view('admin.docentes.edit', compact('docente'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Docente $docente)
    {
        $validated = $request->validate([
            'nombre' => 'required|string|max:255',
            'especialidad' => 'nullable|string|max:255',
            'telefono' => 'nullable|string|max:255',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'activo' => 'boolean',
        ]);

        // Manejar subida de nueva foto
        if ($request->hasFile('foto')) {
            // Eliminar foto anterior si existe
            if ($docente->foto) {
                Storage::disk('public')->delete($docente->foto);
            }
            $validated['foto'] = $request->file('foto')->store('docentes', 'public');
        }

        $docente->update($validated);

        return redirect()->route('admin.docentes.index')
            ->with('success', 'Docente actualizado exitosamente.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Docente $docente)
    {
        // Eliminar foto si existe
        if ($docente->foto) {
            Storage::disk('public')->delete($docente->foto);
        }

        $docente->delete();

        return redirect()->route('admin.docentes.index')
            ->with('success', 'Docente eliminado exitosamente.');
    }
}

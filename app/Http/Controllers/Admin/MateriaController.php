<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Materia;
use App\Models\Carrera;
use App\Models\Semestre;
use Illuminate\Http\Request;

class MateriaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $materias = Materia::with(['carrera', 'semestre'])
            ->latest()
            ->paginate(10);

        return view('admin.materias.index', compact('materias'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $carreras = Carrera::activos()->get();
        $semestres = Semestre::with('carrera')->get();

        return view('admin.materias.create', compact('carreras', 'semestres'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'ID_carrera' => 'required|exists:carreras,ID_carrera',
            'ID_semestre' => 'required|exists:semestres,ID_semestre',
            'Nombre' => 'required|string|max:255',
            'sigla' => 'required|string|max:255',
            'creditos' => 'required|integer|min:1|max:10',
            'descripcion' => 'nullable|string',
            'tiene_auxiliar' => 'boolean',
        ]);

        Materia::create($validated);

        return redirect()->route('admin.materias.index')
            ->with('success', 'Materia creada exitosamente.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Materia $materia)
    {
        $materia->load(['carrera', 'semestre', 'auxiliares']);

        return view('admin.materias.show', compact('materia'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Materia $materia)
    {
        $carreras = Carrera::activos()->get();
        $semestres = Semestre::with('carrera')->get();

        return view('admin.materias.edit', compact('materia', 'carreras', 'semestres'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Materia $materia)
    {
        $validated = $request->validate([
            'ID_carrera' => 'required|exists:carreras,ID_carrera',
            'ID_semestre' => 'required|exists:semestres,ID_semestre',
            'Nombre' => 'required|string|max:255',
            'sigla' => 'required|string|max:255',
            'creditos' => 'required|integer|min:1|max:10',
            'descripcion' => 'nullable|string',
            'tiene_auxiliar' => 'boolean',
        ]);

        $materia->update($validated);

        return redirect()->route('admin.materias.index')
            ->with('success', 'Materia actualizada exitosamente.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Materia $materia)
    {
        $materia->delete();

        return redirect()->route('admin.materias.index')
            ->with('success', 'Materia eliminada exitosamente.');
    }
}

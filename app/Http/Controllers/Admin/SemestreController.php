<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Semestre;
use App\Models\Carrera;
use Illuminate\Http\Request;

class SemestreController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $semestres = Semestre::with('carrera')->latest()->paginate(10);

        return view('admin.semestres.index', compact('semestres'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $carreras = Carrera::activos()->get();

        return view('admin.semestres.create', compact('carreras'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'ID_carrera' => 'required|exists:carreras,ID_carrera',
            'nombre' => 'required|string|max:255',
            'numero_semestre' => 'required|integer|min:1|max:15',
            'tipo' => 'required|in:Regular,Verano',
        ]);

        Semestre::create($validated);

        return redirect()->route('admin.semestres.index')
            ->with('success', 'Semestre creado exitosamente.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Semestre $semestre)
    {
        $semestre->load('carrera', 'materias');

        return view('admin.semestres.show', compact('semestre'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Semestre $semestre)
    {
        $carreras = Carrera::activos()->get();

        return view('admin.semestres.edit', compact('semestre', 'carreras'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Semestre $semestre)
    {
        $validated = $request->validate([
            'ID_carrera' => 'required|exists:carreras,ID_carrera',
            'nombre' => 'required|string|max:255',
            'numero_semestre' => 'required|integer|min:1|max:15',
            'tipo' => 'required|in:Regular,Verano',
        ]);

        $semestre->update($validated);

        return redirect()->route('admin.semestres.index')
            ->with('success', 'Semestre actualizado exitosamente.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Semestre $semestre)
    {
        $semestre->delete();

        return redirect()->route('admin.semestres.index')
            ->with('success', 'Semestre eliminado exitosamente.');
    }
}

<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Carrera;
use Illuminate\Http\Request;

class CarreraController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $carreras = Carrera::latest()->paginate(10);

        return view('admin.carreras.index', compact('carreras'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.carreras.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nombre' => 'required|string|max:255',
            'codigo_carrera' => 'required|string|max:255|unique:carreras,codigo_carrera',
            'activo' => 'boolean',
        ]);

        Carrera::create($validated);

        return redirect()->route('admin.carreras.index')
            ->with('success', 'Carrera creada exitosamente.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Carrera $carrera)
    {
        return view('admin.carreras.show', compact('carrera'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Carrera $carrera)
    {
        return view('admin.carreras.edit', compact('carrera'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Carrera $carrera)
    {
        $validated = $request->validate([
            'nombre' => 'required|string|max:255',
            'codigo_carrera' => 'required|string|max:255|unique:carreras,codigo_carrera,' . $carrera->ID_carrera . ',ID_carrera',
            'activo' => 'boolean',
        ]);

        $carrera->update($validated);

        return redirect()->route('admin.carreras.index')
            ->with('success', 'Carrera actualizada exitosamente.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Carrera $carrera)
    {
        $carrera->delete();

        return redirect()->route('admin.carreras.index')
            ->with('success', 'Carrera eliminada exitosamente.');
    }
}

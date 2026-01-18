<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Gestion;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class GestionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Gestion::query();

        // Filtro por año
        if ($request->filled('anio')) {
            $query->where('anio', $request->anio);
        }

        // Filtro por estado
        if ($request->filled('estado')) {
            switch ($request->estado) {
                case 'actual':
                    $query->where('es_actual', true);
                    break;
                case 'proxima':
                    $query->where('fecha_inicio', '>', now())
                          ->where('es_actual', false);
                    break;
                case 'finalizada':
                    $query->where('fecha_fin', '<', now())
                          ->where('es_actual', false);
                    break;
            }
        }

        // Búsqueda por nombre
        if ($request->filled('buscar')) {
            $query->where('nombre', 'like', '%' . $request->buscar . '%');
        }

        // Ordenar por año y número descendente
        $gestiones = $query->orderBy('anio', 'desc')
                          ->orderBy('numero', 'desc')
                          ->paginate(10)
                          ->withQueryString();

        return view('admin.gestiones.index', compact('gestiones'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.gestiones.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nombre' => 'required|string|max:255',
            'numero' => 'required|integer|in:1,2',
            'anio' => 'required|integer|min:2020|max:2030',
            'fecha_inicio' => 'required|date',
            'fecha_fin' => 'required|date|after:fecha_inicio',
            'es_actual' => 'nullable|boolean',
        ], [
            'nombre.required' => 'El nombre es obligatorio',
            'numero.required' => 'El número de semestre es obligatorio',
            'numero.in' => 'El número de semestre debe ser 1 o 2',
            'anio.required' => 'El año es obligatorio',
            'fecha_inicio.required' => 'La fecha de inicio es obligatoria',
            'fecha_fin.required' => 'La fecha de fin es obligatoria',
            'fecha_fin.after' => 'La fecha de fin debe ser posterior a la fecha de inicio',
        ]);

        // Verificar si ya existe una gestión con el mismo número y año
        $existeGestion = Gestion::where('numero', $validated['numero'])
                                ->where('anio', $validated['anio'])
                                ->exists();

        if ($existeGestion) {
            return back()
                ->withInput()
                ->withErrors(['numero' => 'Ya existe una gestión para este semestre y año']);
        }

        DB::beginTransaction();
        try {
            // Si se marca como actual, desactivar todas las demás
            if ($request->has('es_actual') && $request->es_actual) {
                Gestion::where('es_actual', true)->update(['es_actual' => false]);
                $validated['es_actual'] = true;
            } else {
                $validated['es_actual'] = false;
            }

            Gestion::create($validated);

            DB::commit();

            return redirect()
                ->route('admin.gestiones.index')
                ->with('success', 'Gestión creada exitosamente');

        } catch (\Exception $e) {
            DB::rollBack();
            return back()
                ->withInput()
                ->withErrors(['error' => 'Error al crear la gestión: ' . $e->getMessage()]);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $gestion = Gestion::with(['materiaGestionDocente', 'horarios', 'gruposWhatsapp'])
                         ->findOrFail($id);

        return view('admin.gestiones.show', compact('gestion'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $gestion = Gestion::with(['materiaGestionDocente', 'horarios'])
                         ->findOrFail($id);

        return view('admin.gestiones.edit', compact('gestion'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $gestion = Gestion::findOrFail($id);

        $validated = $request->validate([
            'nombre' => 'required|string|max:255',
            'numero' => 'required|integer|in:1,2',
            'anio' => 'required|integer|min:2020|max:2030',
            'fecha_inicio' => 'required|date',
            'fecha_fin' => 'required|date|after:fecha_inicio',
            'es_actual' => 'nullable|boolean',
        ], [
            'nombre.required' => 'El nombre es obligatorio',
            'numero.required' => 'El número de semestre es obligatorio',
            'numero.in' => 'El número de semestre debe ser 1 o 2',
            'anio.required' => 'El año es obligatorio',
            'fecha_inicio.required' => 'La fecha de inicio es obligatoria',
            'fecha_fin.required' => 'La fecha de fin es obligatoria',
            'fecha_fin.after' => 'La fecha de fin debe ser posterior a la fecha de inicio',
        ]);

        // Verificar si ya existe otra gestión con el mismo número y año
        $existeGestion = Gestion::where('numero', $validated['numero'])
                                ->where('anio', $validated['anio'])
                                ->where('ID_gestion', '!=', $id)
                                ->exists();

        if ($existeGestion) {
            return back()
                ->withInput()
                ->withErrors(['numero' => 'Ya existe otra gestión para este semestre y año']);
        }

        DB::beginTransaction();
        try {
            // Si se marca como actual, desactivar todas las demás
            if ($request->has('es_actual') && $request->es_actual) {
                Gestion::where('es_actual', true)
                       ->where('ID_gestion', '!=', $id)
                       ->update(['es_actual' => false]);
                $validated['es_actual'] = true;
            } else {
                $validated['es_actual'] = false;
            }

            $gestion->update($validated);

            DB::commit();

            return redirect()
                ->route('admin.gestiones.index')
                ->with('success', 'Gestión actualizada exitosamente');

        } catch (\Exception $e) {
            DB::rollBack();
            return back()
                ->withInput()
                ->withErrors(['error' => 'Error al actualizar la gestión: ' . $e->getMessage()]);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $gestion = Gestion::findOrFail($id);

        // Verificar si la gestión está siendo utilizada
        $tieneRelaciones = $gestion->materiaGestionDocente()->exists() ||
                          $gestion->horarios()->exists() ||
                          $gestion->gruposWhatsapp()->exists();

        if ($tieneRelaciones) {
            return back()->with('error',
                'No se puede eliminar esta gestión porque está siendo utilizada por materias, horarios o grupos de WhatsApp.'
            );
        }

        // No permitir eliminar la gestión actual
        if ($gestion->es_actual) {
            return back()->with('error',
                'No se puede eliminar la gestión actual. Primero debe desactivarla.'
            );
        }

        try {
            $gestion->delete();

            return redirect()
                ->route('admin.gestiones.index')
                ->with('success', 'Gestión eliminada exitosamente');

        } catch (\Exception $e) {
            return back()->with('error',
                'Error al eliminar la gestión: ' . $e->getMessage()
            );
        }
    }
}

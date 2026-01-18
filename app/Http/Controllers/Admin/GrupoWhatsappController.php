<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\GrupoWhatsapp;
use App\Models\Gestion;
use App\Models\Materia;
use Illuminate\Http\Request;

class GrupoWhatsappController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = GrupoWhatsapp::with(['gestion', 'materia.semestre.carrera']);

        // Filtro por gestión
        if ($request->filled('ID_gestion')) {
            $query->where('ID_gestion', $request->ID_gestion);
        }

        // Filtro por materia
        if ($request->filled('ID_materia')) {
            $query->where('ID_materia', $request->ID_materia);
        }

        // Búsqueda por nombre de materia
        if ($request->filled('buscar')) {
            $query->whereHas('materia', function($q) use ($request) {
                $q->where('nombre', 'like', '%' . $request->buscar . '%');
            });
        }

        $grupos = $query->orderBy('created_at', 'desc')
                       ->paginate(10)
                       ->withQueryString();

        // Datos para los filtros
        $gestiones = Gestion::orderBy('anio', 'desc')->orderBy('numero', 'desc')->get();
        $materias = Materia::with('semestre.carrera')->orderBy('nombre')->get();

        return view('admin.grupos-whatsapp.index', compact('grupos', 'gestiones', 'materias'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $gestiones = Gestion::orderBy('anio', 'desc')->orderBy('numero', 'desc')->get();
        $materias = Materia::with('semestre.carrera')->orderBy('nombre')->get();

        return view('admin.grupos-whatsapp.create', compact('gestiones', 'materias'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'ID_gestion' => 'required|exists:gestiones,ID_gestion',
            'ID_materia' => 'required|exists:materias,ID_materia',
            'link' => 'required|url|max:500',
        ], [
            'ID_gestion.required' => 'La gestión es obligatoria',
            'ID_gestion.exists' => 'La gestión seleccionada no existe',
            'ID_materia.required' => 'La materia es obligatoria',
            'ID_materia.exists' => 'La materia seleccionada no existe',
            'link.required' => 'El link de WhatsApp es obligatorio',
            'link.url' => 'El link debe ser una URL válida',
            'link.max' => 'El link no puede tener más de 500 caracteres',
        ]);

        // Validar que el link sea de WhatsApp
        if (!$this->esLinkWhatsapp($validated['link'])) {
            return back()
                ->withInput()
                ->withErrors(['link' => 'El link debe ser un enlace válido de WhatsApp (chat.whatsapp.com o wa.me)']);
        }

        // Verificar si ya existe un grupo para esta materia y gestión
        $existeGrupo = GrupoWhatsapp::where('ID_gestion', $validated['ID_gestion'])
                                     ->where('ID_materia', $validated['ID_materia'])
                                     ->exists();

        if ($existeGrupo) {
            return back()
                ->withInput()
                ->withErrors(['ID_materia' => 'Ya existe un grupo de WhatsApp para esta materia en la gestión seleccionada']);
        }

        try {
            GrupoWhatsapp::create($validated);

            return redirect()
                ->route('admin.grupos-whatsapp.index')
                ->with('success', 'Grupo de WhatsApp creado exitosamente');

        } catch (\Exception $e) {
            return back()
                ->withInput()
                ->withErrors(['error' => 'Error al crear el grupo: ' . $e->getMessage()]);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $grupo = GrupoWhatsapp::with(['gestion', 'materia.semestre.carrera'])->findOrFail($id);

        return view('admin.grupos-whatsapp.show', compact('grupo'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $grupo = GrupoWhatsapp::findOrFail($id);
        $gestiones = Gestion::orderBy('anio', 'desc')->orderBy('numero', 'desc')->get();
        $materias = Materia::with('semestre.carrera')->orderBy('nombre')->get();

        return view('admin.grupos-whatsapp.edit', compact('grupo', 'gestiones', 'materias'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $grupo = GrupoWhatsapp::findOrFail($id);

        $validated = $request->validate([
            'ID_gestion' => 'required|exists:gestiones,ID_gestion',
            'ID_materia' => 'required|exists:materias,ID_materia',
            'link' => 'required|url|max:500',
        ], [
            'ID_gestion.required' => 'La gestión es obligatoria',
            'ID_materia.required' => 'La materia es obligatoria',
            'link.required' => 'El link de WhatsApp es obligatorio',
            'link.url' => 'El link debe ser una URL válida',
        ]);

        // Validar que el link sea de WhatsApp
        if (!$this->esLinkWhatsapp($validated['link'])) {
            return back()
                ->withInput()
                ->withErrors(['link' => 'El link debe ser un enlace válido de WhatsApp (chat.whatsapp.com o wa.me)']);
        }

        // Verificar si ya existe otro grupo para esta materia y gestión
        $existeGrupo = GrupoWhatsapp::where('ID_gestion', $validated['ID_gestion'])
                                     ->where('ID_materia', $validated['ID_materia'])
                                     ->where('ID_grupo', '!=', $id)
                                     ->exists();

        if ($existeGrupo) {
            return back()
                ->withInput()
                ->withErrors(['ID_materia' => 'Ya existe otro grupo de WhatsApp para esta materia en la gestión seleccionada']);
        }

        try {
            $grupo->update($validated);

            return redirect()
                ->route('admin.grupos-whatsapp.index')
                ->with('success', 'Grupo de WhatsApp actualizado exitosamente');

        } catch (\Exception $e) {
            return back()
                ->withInput()
                ->withErrors(['error' => 'Error al actualizar el grupo: ' . $e->getMessage()]);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $grupo = GrupoWhatsapp::findOrFail($id);

        try {
            $grupo->delete();

            return redirect()
                ->route('admin.grupos-whatsapp.index')
                ->with('success', 'Grupo de WhatsApp eliminado exitosamente');

        } catch (\Exception $e) {
            return back()->with('error',
                'Error al eliminar el grupo: ' . $e->getMessage()
            );
        }
    }

    /**
     * Validar si es un link válido de WhatsApp
     */
    private function esLinkWhatsapp($link)
    {
        $patronesWhatsapp = [
            'chat.whatsapp.com',
            'wa.me',
            'api.whatsapp.com',
        ];

        foreach ($patronesWhatsapp as $patron) {
            if (strpos($link, $patron) !== false) {
                return true;
            }
        }

        return false;
    }
}

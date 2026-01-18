<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Horario;
use App\Models\Gestion;
use App\Models\Semestre;
use App\Models\Carrera;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class HorarioController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Horario::with(['gestion', 'semestre', 'carrera']);

        // Filtro por gestión
        if ($request->filled('ID_gestion')) {
            $query->where('ID_gestion', $request->ID_gestion);
        }

        // Filtro por carrera
        if ($request->filled('ID_carrera')) {
            $query->where('ID_carrera', $request->ID_carrera);
        }

        // Filtro por semestre
        if ($request->filled('ID_semestre')) {
            $query->where('ID_semestre', $request->ID_semestre);
        }

        // Filtro por tipo de archivo
        if ($request->filled('archivo_tipo')) {
            $query->where('archivo_tipo', $request->archivo_tipo);
        }

        // Búsqueda por nombre de archivo
        if ($request->filled('buscar')) {
            $query->where('archivo_nombre', 'like', '%' . $request->buscar . '%');
        }

        $horarios = $query->orderBy('created_at', 'desc')
                          ->paginate(10)
                          ->withQueryString();

        // Datos para los filtros
        $gestiones = Gestion::orderBy('anio', 'desc')->orderBy('numero', 'desc')->get();
        $carreras = Carrera::orderBy('nombre')->get();
        $semestres = Semestre::with('carrera')->orderBy('numero_semestre')->get();

        return view('admin.horarios.index', compact('horarios', 'gestiones', 'carreras', 'semestres'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $gestiones = Gestion::orderBy('anio', 'desc')->orderBy('numero', 'desc')->get();
        $carreras = Carrera::orderBy('nombre')->get();
        $semestres = Semestre::with('carrera')->orderBy('numero_semestre')->get();

        return view('admin.horarios.create', compact('gestiones', 'carreras', 'semestres'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'ID_gestion' => 'required|exists:gestiones,ID_gestion',
            'ID_carrera' => 'required|exists:carreras,ID_carrera',
            'ID_semestre' => 'nullable|exists:semestres,ID_semestre',
            'archivo_tipo' => 'required|in:pdf,imagen,excel,word,texto',
            'archivo' => 'required|file|max:10240', // 10MB máximo
        ], [
            'ID_gestion.required' => 'La gestión es obligatoria',
            'ID_gestion.exists' => 'La gestión seleccionada no existe',
            'ID_carrera.required' => 'La carrera es obligatoria',
            'ID_carrera.exists' => 'La carrera seleccionada no existe',
            'ID_semestre.exists' => 'El semestre seleccionado no existe',
            'archivo_tipo.required' => 'El tipo de archivo es obligatorio',
            'archivo_tipo.in' => 'El tipo de archivo no es válido',
            'archivo.required' => 'Debe seleccionar un archivo',
            'archivo.max' => 'El archivo no puede pesar más de 10MB',
        ]);

        // Validar extensión del archivo según el tipo
        $file = $request->file('archivo');
        $extension = $file->getClientOriginalExtension();

        $extensionesPermitidas = [
            'pdf' => ['pdf'],
            'imagen' => ['jpg', 'jpeg', 'png', 'gif', 'webp'],
            'excel' => ['xls', 'xlsx', 'csv'],
            'word' => ['doc', 'docx'],
            'texto' => ['txt'],
        ];

        if (!in_array(strtolower($extension), $extensionesPermitidas[$validated['archivo_tipo']])) {
            return back()
                ->withInput()
                ->withErrors(['archivo' => 'La extensión del archivo no coincide con el tipo seleccionado']);
        }

        try {
            // Generar nombre único para el archivo
            $nombreArchivo = time() . '_' . $file->getClientOriginalName();

            // Guardar el archivo en storage/app/public/horarios
            $rutaArchivo = $file->storeAs('horarios', $nombreArchivo, 'public');

            // Crear el registro
            $validated['archivo_nombre'] = $file->getClientOriginalName();
            $validated['archivo_ruta'] = $rutaArchivo;

            Horario::create($validated);

            return redirect()
                ->route('admin.horarios.index')
                ->with('success', 'Horario creado exitosamente');

        } catch (\Exception $e) {
            // Eliminar el archivo si hubo error al guardar en BD
            if (isset($rutaArchivo)) {
                Storage::disk('public')->delete($rutaArchivo);
            }

            return back()
                ->withInput()
                ->withErrors(['error' => 'Error al crear el horario: ' . $e->getMessage()]);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $horario = Horario::with(['gestion', 'semestre', 'carrera'])->findOrFail($id);

        return view('admin.horarios.show', compact('horario'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $horario = Horario::findOrFail($id);
        $gestiones = Gestion::orderBy('anio', 'desc')->orderBy('numero', 'desc')->get();
        $carreras = Carrera::orderBy('nombre')->get();
        $semestres = Semestre::with('carrera')->orderBy('numero_semestre')->get();

        return view('admin.horarios.edit', compact('horario', 'gestiones', 'carreras', 'semestres'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $horario = Horario::findOrFail($id);

        $validated = $request->validate([
            'ID_gestion' => 'required|exists:gestiones,ID_gestion',
            'ID_carrera' => 'required|exists:carreras,ID_carrera',
            'ID_semestre' => 'nullable|exists:semestres,ID_semestre',
            'archivo_tipo' => 'required|in:pdf,imagen,excel,word,texto',
            'archivo' => 'nullable|file|max:10240', // Opcional en edición
        ], [
            'ID_gestion.required' => 'La gestión es obligatoria',
            'ID_carrera.required' => 'La carrera es obligatoria',
            'archivo_tipo.required' => 'El tipo de archivo es obligatorio',
            'archivo.max' => 'El archivo no puede pesar más de 10MB',
        ]);

        try {
            // Si se subió un nuevo archivo
            if ($request->hasFile('archivo')) {
                $file = $request->file('archivo');
                $extension = $file->getClientOriginalExtension();

                $extensionesPermitidas = [
                    'pdf' => ['pdf'],
                    'imagen' => ['jpg', 'jpeg', 'png', 'gif', 'webp'],
                    'excel' => ['xls', 'xlsx', 'csv'],
                    'word' => ['doc', 'docx'],
                    'texto' => ['txt'],
                ];

                if (!in_array(strtolower($extension), $extensionesPermitidas[$validated['archivo_tipo']])) {
                    return back()
                        ->withInput()
                        ->withErrors(['archivo' => 'La extensión del archivo no coincide con el tipo seleccionado']);
                }

                // Eliminar archivo anterior
                if ($horario->archivo_ruta) {
                    Storage::disk('public')->delete($horario->archivo_ruta);
                }

                // Guardar nuevo archivo
                $nombreArchivo = time() . '_' . $file->getClientOriginalName();
                $rutaArchivo = $file->storeAs('horarios', $nombreArchivo, 'public');

                $validated['archivo_nombre'] = $file->getClientOriginalName();
                $validated['archivo_ruta'] = $rutaArchivo;
            }

            $horario->update($validated);

            return redirect()
                ->route('admin.horarios.index')
                ->with('success', 'Horario actualizado exitosamente');

        } catch (\Exception $e) {
            // Eliminar el archivo nuevo si hubo error
            if (isset($rutaArchivo)) {
                Storage::disk('public')->delete($rutaArchivo);
            }

            return back()
                ->withInput()
                ->withErrors(['error' => 'Error al actualizar el horario: ' . $e->getMessage()]);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $horario = Horario::findOrFail($id);

        try {
            // Eliminar el archivo físico
            if ($horario->archivo_ruta) {
                Storage::disk('public')->delete($horario->archivo_ruta);
            }

            $horario->delete();

            return redirect()
                ->route('admin.horarios.index')
                ->with('success', 'Horario eliminado exitosamente');

        } catch (\Exception $e) {
            return back()->with('error',
                'Error al eliminar el horario: ' . $e->getMessage()
            );
        }
    }

    /**
     * Descargar archivo
     */
    public function descargar(string $id)
    {
        $horario = Horario::findOrFail($id);

        if (!$horario->archivo_ruta || !Storage::disk('public')->exists($horario->archivo_ruta)) {
            return back()->with('error', 'El archivo no existe');
        }

        return Storage::disk('public')->download($horario->archivo_ruta, $horario->archivo_nombre);
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class MaterialAcademico extends Model
{
    protected $table = 'material_academico';
    protected $primaryKey = 'ID_material';

    protected $fillable = [
        'ID_materia_gestion_docente',
        'titulo',
        'descripcion',
        'tipo_material',
        'archivo_nombre',
        'archivo_ruta',
        'archivo_tipo',
        'archivo_tamanio',
    ];

    protected $casts = [
        'archivo_tamanio' => 'integer',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    // Relaciones
    public function materiaGestionDocente(): BelongsTo
    {
        return $this->belongsTo(MateriaGestionDocente::class, 'ID_materia_gestion_docente', 'ID_materia_gestion_docente');
    }

    // Scopes
    public function scopeContenidos($query)
    {
        return $query->where('tipo_material', 'Contenidos');
    }

    public function scopePracticos($query)
    {
        return $query->where('tipo_material', 'Practicos');
    }

    public function scopeProyectos($query)
    {
        return $query->where('tipo_material', 'Proyectos');
    }

    public function scopeExamenes($query)
    {
        return $query->where('tipo_material', 'Examenes');
    }

    // Accessors
    public function getArchivoUrlAttribute()
    {
        return $this->archivo_ruta ? asset('storage/' . $this->archivo_ruta) : null;
    }

    public function getTamanioFormateadoAttribute()
    {
        if (!$this->archivo_tamanio) return null;

        $bytes = $this->archivo_tamanio;
        $units = ['B', 'KB', 'MB', 'GB'];

        for ($i = 0; $bytes > 1024; $i++) {
            $bytes /= 1024;
        }

        return round($bytes, 2) . ' ' . $units[$i];
    }
}

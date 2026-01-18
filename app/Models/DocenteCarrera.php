<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class DocenteCarrera extends Model
{
    protected $table = 'docentes_carrera';
    protected $primaryKey = 'ID_docente_carrera';

    protected $fillable = [
        'ID_carrera',
        'ID_docente',
        'fecha_asignacion',
        'activo',
    ];

    protected $casts = [
        'fecha_asignacion' => 'datetime',
        'activo' => 'boolean',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    // Relaciones
    public function carrera(): BelongsTo
    {
        return $this->belongsTo(Carrera::class, 'ID_carrera', 'ID_carrera');
    }

    public function docente(): BelongsTo
    {
        return $this->belongsTo(Docente::class, 'ID_docente', 'ID_docente');
    }

    // Scopes
    public function scopeActivos($query)
    {
        return $query->where('activo', true);
    }
}

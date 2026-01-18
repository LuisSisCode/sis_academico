<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Horario extends Model
{
    protected $table = 'horarios';
    protected $primaryKey = 'ID_horario';

    protected $fillable = [
        'ID_gestion',
        'ID_semestre',  // ← AGREGAR ESTO
        'ID_carrera',
        'archivo_tipo',
        'archivo_nombre',
        'archivo_ruta',
    ];

    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    // Relaciones
    public function gestion(): BelongsTo
    {
        return $this->belongsTo(Gestion::class, 'ID_gestion', 'ID_gestion');
    }

    public function carrera(): BelongsTo
    {
        return $this->belongsTo(Carrera::class, 'ID_carrera', 'ID_carrera');
    }

    // ← AGREGAR ESTA RELACIÓN
    public function semestre(): BelongsTo
    {
        return $this->belongsTo(Semestre::class, 'ID_semestre', 'ID_semestre');
    }

    // Accessors
    public function getArchivoUrlAttribute()
    {
        return $this->archivo_ruta ? asset('storage/' . $this->archivo_ruta) : null;
    }

    public function getEsImagenAttribute()
    {
        return in_array($this->archivo_tipo, ['imagen']);
    }

    public function getEsPdfAttribute()
    {
        return $this->archivo_tipo === 'pdf';
    }
}

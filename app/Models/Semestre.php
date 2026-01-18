<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Semestre extends Model
{
    protected $table = 'semestres';
    protected $primaryKey = 'ID_semestre';

    protected $fillable = [
        'ID_carrera',
        'nombre',
        'numero_semestre',
        'tipo',
    ];

    protected $casts = [
        'numero_semestre' => 'integer',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    // Relaciones
    public function carrera(): BelongsTo
    {
        return $this->belongsTo(Carrera::class, 'ID_carrera', 'ID_carrera');
    }

    public function materias(): HasMany
    {
        return $this->hasMany(Materia::class, 'ID_semestre', 'ID_semestre');
    }

    // ← AGREGAR ESTA RELACIÓN
    public function horarios(): HasMany
    {
        return $this->hasMany(Horario::class, 'ID_semestre', 'ID_semestre');
    }

    // Scopes
    public function scopeRegulares($query)
    {
        return $query->where('tipo', 'Regular');
    }

    public function scopeVerano($query)
    {
        return $query->where('tipo', 'Verano');
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class MateriaGestionDocente extends Model
{
    protected $table = 'materia_gestion_docente';
    protected $primaryKey = 'ID_materia_gestion_docente';

    protected $fillable = [
        'ID_docente',
        'ID_materia',
        'ID_gestion',
        'activo',
    ];

    protected $casts = [
        'activo' => 'boolean',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    // Relaciones
    public function docente(): BelongsTo
    {
        return $this->belongsTo(Docente::class, 'ID_docente', 'ID_docente');
    }

    public function materia(): BelongsTo
    {
        return $this->belongsTo(Materia::class, 'ID_materia', 'ID_materia');
    }

    public function gestion(): BelongsTo
    {
        return $this->belongsTo(Gestion::class, 'ID_gestion', 'ID_gestion');
    }

    public function materialesAcademicos(): HasMany
    {
        return $this->hasMany(MaterialAcademico::class, 'ID_materia_gestion_docente', 'ID_materia_gestion_docente');
    }

    // Scopes
    public function scopeActivos($query)
    {
        return $query->where('activo', true);
    }
}

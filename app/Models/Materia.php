<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Materia extends Model
{
    protected $table = 'materias';
    protected $primaryKey = 'ID_materia';

    protected $fillable = [
        'ID_carrera',
        'ID_semestre',
        'Nombre',
        'sigla',
        'creditos',
        'descripcion',
        'tiene_auxiliar',
    ];

    protected $casts = [
        'creditos' => 'integer',
        'tiene_auxiliar' => 'boolean',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    // Relaciones
    public function carrera(): BelongsTo
    {
        return $this->belongsTo(Carrera::class, 'ID_carrera', 'ID_carrera');
    }

    public function semestre(): BelongsTo
    {
        return $this->belongsTo(Semestre::class, 'ID_semestre', 'ID_semestre');
    }

    public function auxiliares(): HasMany
    {
        return $this->hasMany(Auxiliar::class, 'ID_materia', 'ID_materia');
    }

    public function materiaGestionDocente(): HasMany
    {
        return $this->hasMany(MateriaGestionDocente::class, 'ID_materia', 'ID_materia');
    }

    public function gruposWhatsapp(): HasMany
    {
        return $this->hasMany(GrupoWhatsapp::class, 'ID_materia', 'ID_materia');
    }

    // ⭐ NUEVA RELACIÓN
    public function docenteMaterias(): HasMany
    {
        return $this->hasMany(DocenteMateria::class, 'ID_materia', 'ID_materia');
    }

    // Relación directa con docentes (muchos a muchos)
    public function docentes(): BelongsToMany
    {
        return $this->belongsToMany(
            Docente::class,
            'docente_materia',
            'ID_materia',
            'ID_docente',
            'ID_materia',
            'ID_docente'
        )->withTimestamps();
    }

    // Scopes
    public function scopeConAuxiliar($query)
    {
        return $query->where('tiene_auxiliar', true);
    }

    public function scopeSinAuxiliar($query)
    {
        return $query->where('tiene_auxiliar', false);
    }
}

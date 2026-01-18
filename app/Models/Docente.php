<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Docente extends Model
{
    protected $table = 'docentes';
    protected $primaryKey = 'ID_docente';

    protected $fillable = [
        'nombre',
        'especialidad',
        'telefono',
        'foto',
        'activo',
    ];

    protected $casts = [
        'activo' => 'boolean',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    // Relaciones
    public function docentesCarrera(): HasMany
    {
        return $this->hasMany(DocenteCarrera::class, 'ID_docente', 'ID_docente');
    }

    public function materiaGestionDocente(): HasMany
    {
        return $this->hasMany(MateriaGestionDocente::class, 'ID_docente', 'ID_docente');
    }

    // ⭐ NUEVA RELACIÓN
    public function docenteMaterias(): HasMany
    {
        return $this->hasMany(DocenteMateria::class, 'ID_docente', 'ID_docente');
    }

    // Relación directa con materias (muchos a muchos)
    public function materias(): BelongsToMany
    {
        return $this->belongsToMany(
            Materia::class,
            'docente_materia',
            'ID_docente',
            'ID_materia',
            'ID_docente',
            'ID_materia'
        )->withTimestamps();
    }

    // Scopes
    public function scopeActivos($query)
    {
        return $query->where('activo', true);
    }

    // Accessors
    public function getFotoUrlAttribute()
    {
        return $this->foto ? asset('storage/' . $this->foto) : asset('images/default-avatar.png');
    }
}

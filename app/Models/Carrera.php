<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Carrera extends Model
{
    protected $table = 'carreras';
    protected $primaryKey = 'ID_carrera';

    protected $fillable = [
        'nombre',
        'codigo_carrera',
        'activo',
    ];

    protected $casts = [
        'activo' => 'boolean',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    // Relaciones
    public function semestres(): HasMany
    {
        return $this->hasMany(Semestre::class, 'ID_carrera', 'ID_carrera');
    }

    public function materias(): HasMany
    {
        return $this->hasMany(Materia::class, 'ID_carrera', 'ID_carrera');
    }

    public function auxiliares(): HasMany
    {
        return $this->hasMany(Auxiliar::class, 'ID_carrera', 'ID_carrera');
    }

    public function users(): HasMany
    {
        return $this->hasMany(User::class, 'ID_carrera', 'ID_carrera');
    }

    public function docentesCarrera(): HasMany
    {
        return $this->hasMany(DocenteCarrera::class, 'ID_carrera', 'ID_carrera');
    }

    public function horarios(): HasMany
    {
        return $this->hasMany(Horario::class, 'ID_carrera', 'ID_carrera');
    }

    // Scopes
    public function scopeActivos($query)
    {
        return $query->where('activo', true);
    }
}

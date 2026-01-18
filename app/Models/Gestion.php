<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Gestion extends Model
{
    protected $table = 'gestiones';
    protected $primaryKey = 'ID_gestion';

    protected $fillable = [
        'nombre',
        'numero',
        'anio',
        'es_actual',
        'fecha_inicio',
        'fecha_fin',
    ];

    protected $casts = [
        'numero' => 'integer',
        'anio' => 'integer',
        'es_actual' => 'boolean',
        'fecha_inicio' => 'datetime',
        'fecha_fin' => 'datetime',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    // Relaciones
    public function materiaGestionDocente(): HasMany
    {
        return $this->hasMany(MateriaGestionDocente::class, 'ID_gestion', 'ID_gestion');
    }

    public function horarios(): HasMany
    {
        return $this->hasMany(Horario::class, 'ID_gestion', 'ID_gestion');
    }

    public function gruposWhatsapp(): HasMany
    {
        return $this->hasMany(GrupoWhatsapp::class, 'ID_gestion', 'ID_gestion');
    }

    // Scopes
    public function scopeActual($query)
    {
        return $query->where('es_actual', true);
    }

    public function scopeDelAnio($query, $anio)
    {
        return $query->where('anio', $anio);
    }

    // Métodos auxiliares
    public function getNombreCompletoAttribute()
    {
        return "{$this->numero}-{$this->anio}";
    }
}

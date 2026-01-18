<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Auxiliar extends Model
{
    protected $table = 'auxiliares';
    protected $primaryKey = 'ID_auxiliar';

    protected $fillable = [
        'ID_materia',
        'ID_carrera',
        'ID_users',
        'celular',
        'foto',
        'activo',
    ];

    protected $casts = [
        'activo' => 'boolean',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    // Relaciones
    public function materia(): BelongsTo
    {
        return $this->belongsTo(Materia::class, 'ID_materia', 'ID_materia');
    }

    public function carrera(): BelongsTo
    {
        return $this->belongsTo(Carrera::class, 'ID_carrera', 'ID_carrera');
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'ID_users', 'ID_users');
    }

    public function materialesAuxiliar(): HasMany
    {
        return $this->hasMany(MaterialAuxiliar::class, 'ID_auxiliar', 'ID_auxiliar');
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

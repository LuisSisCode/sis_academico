<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class MaterialEnlace extends Model
{
    protected $table = 'material_enlaces';
    protected $primaryKey = 'ID_material_enlaces';

    protected $fillable = [
        'ID_material_auxiliar',
        'url',
        'Descripcion',
        'orden',
    ];

    protected $casts = [
        'orden' => 'integer',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    // Relaciones
    public function materialAuxiliar(): BelongsTo
    {
        return $this->belongsTo(MaterialAuxiliar::class, 'ID_material_auxiliar', 'ID_material_auxiliar');
    }

    // Scopes
    public function scopeOrdenados($query)
    {
        return $query->orderBy('orden', 'asc');
    }
}

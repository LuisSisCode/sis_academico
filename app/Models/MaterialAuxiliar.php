<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class MaterialAuxiliar extends Model
{
    protected $table = 'material_auxiliar';
    protected $primaryKey = 'ID_material_auxiliar';

    protected $fillable = [
        'ID_auxiliar',
        'titulo',
        'descripcion',
        'archivo_nombre',
        'archivo_ruta',
        'archivo_tipo',
        'archivo_tamanio',
        'enlaces',
    ];

    protected $casts = [
        'archivo_tamanio' => 'integer',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    // Relaciones
    public function auxiliar(): BelongsTo
    {
        return $this->belongsTo(Auxiliar::class, 'ID_auxiliar', 'ID_auxiliar');
    }

    public function materialEnlaces(): HasMany
    {
        return $this->hasMany(MaterialEnlace::class, 'ID_material_auxiliar', 'ID_material_auxiliar');
    }

    // Accessors
    public function getArchivoUrlAttribute()
    {
        return $this->archivo_ruta ? asset('storage/' . $this->archivo_ruta) : null;
    }

    public function getTamanioFormateadoAttribute()
    {
        if (!$this->archivo_tamanio) return null;

        $bytes = $this->archivo_tamanio;
        $units = ['B', 'KB', 'MB', 'GB'];

        for ($i = 0; $bytes > 1024; $i++) {
            $bytes /= 1024;
        }

        return round($bytes, 2) . ' ' . $units[$i];
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class GrupoWhatsapp extends Model
{
    protected $table = 'grupo_whatsapp';
    protected $primaryKey = 'ID_grupo';

    protected $fillable = [
        'ID_gestion',
        'ID_materia',
        'link',
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

    public function materia(): BelongsTo
    {
        return $this->belongsTo(Materia::class, 'ID_materia', 'ID_materia');
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class DocenteMateria extends Model
{
    protected $table = 'docente_materia';
    protected $primaryKey = 'ID_docente_materia';

    protected $fillable = [
        'ID_docente',
        'ID_materia',
    ];

    protected $casts = [
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
}

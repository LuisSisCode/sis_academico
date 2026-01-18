<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $table = 'users';
    protected $primaryKey = 'ID_users';

    protected $fillable = [
        'ID_carrera',
        'nombre',
        'email',
        'password',
        'tipo_usuario',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    // Relaciones
    public function carrera(): BelongsTo
    {
        return $this->belongsTo(Carrera::class, 'ID_carrera', 'ID_carrera');
    }

    public function auxiliar(): HasOne
    {
        return $this->hasOne(Auxiliar::class, 'ID_users', 'ID_users');
    }

    // Métodos de rol
    public function isSuperUsuario(): bool
    {
        return $this->tipo_usuario === 'Super usuario';
    }

    public function isAdmin(): bool
    {
        return $this->tipo_usuario === 'Admin';
    }

    public function isAuxiliar(): bool
    {
        return $this->tipo_usuario === 'Auxiliar';
    }

    public function hasAdminAccess(): bool
    {
        return in_array($this->tipo_usuario, ['Super usuario', 'Admin']);
    }

    // Scopes
    public function scopeSuperUsuarios($query)
    {
        return $query->where('tipo_usuario', 'Super usuario');
    }

    public function scopeAdmins($query)
    {
        return $query->where('tipo_usuario', 'Admin');
    }

    public function scopeAuxiliares($query)
    {
        return $query->where('tipo_usuario', 'Auxiliar');
    }
}

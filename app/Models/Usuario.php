<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Usuario extends Model
{
    protected $table = 't_usuario';
    protected $primaryKey = 'id_usuario';
    public $timestamps = false;

    protected $fillable = [
        'nombre_usuario', 'contrasena', 'rol', 'estado', 'intentos_fallidos',
        'fecha_bloqueo_inicio', 'fecha_bloqueo_fin',
        'fecha_habilitacion_inicio', 'fecha_habilitacion_fin',
    ];

    protected $hidden = ['contrasena'];

    protected $casts = [
        'intentos_fallidos'         => 'integer',
        'fecha_bloqueo_inicio'      => 'datetime',
        'fecha_bloqueo_fin'         => 'datetime',
        'fecha_habilitacion_inicio' => 'date',
        'fecha_habilitacion_fin'    => 'date',
    ];

    public function servicios(): HasMany
    {
        return $this->hasMany(Servicio::class, 'id_usuario_registro', 'id_usuario');
    }

    public function auditorias(): HasMany
    {
        return $this->hasMany(Auditoria::class, 'id_usuario', 'id_usuario');
    }
}

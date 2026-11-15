<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Servicio extends Model
{
    protected $table = 't_servicio';
    protected $primaryKey = 'id_servicio';
    public $timestamps = false;

    protected $fillable = [
        'id_cliente', 'id_ubicacion', 'fecha_inicio', 'estado',
        'fecha_fin', 'motivo_fin', 'id_usuario_registro',
    ];

    protected $casts = [
        'fecha_inicio' => 'date',
        'fecha_fin'    => 'date',
    ];

    public function cliente(): BelongsTo
    {
        return $this->belongsTo(Cliente::class, 'id_cliente', 'id_cliente');
    }

    public function ubicacion(): BelongsTo
    {
        return $this->belongsTo(Ubicacion::class, 'id_ubicacion', 'id_ubicacion');
    }

    public function usuarioRegistro(): BelongsTo
    {
        return $this->belongsTo(Usuario::class, 'id_usuario_registro', 'id_usuario');
    }

    public function cenizarios(): HasMany
    {
        return $this->hasMany(Cenizario::class, 'id_servicio', 'id_servicio');
    }

    public function fallecidos(): HasMany
    {
        return $this->hasMany(Fallecido::class, 'id_servicio', 'id_servicio');
    }

    public function pagos(): HasMany
    {
        return $this->hasMany(Pago::class, 'id_servicio', 'id_servicio');
    }
}

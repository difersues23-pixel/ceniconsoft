<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Fallecido extends Model
{
    protected $table = 't_fallecido';
    protected $primaryKey = 'id_fallecido';
    public $timestamps = false;

    protected $fillable = [
        'id_servicio', 'id_cenizario', 'nombres', 'apellidos', 'numero_identificacion',
        'fecha_nacimiento', 'fecha_fallecimiento', 'fecha_deposito', 'estado',
        'retiro_tipo', 'retiro_fecha', 'retiro_motivo', 'retiro_recibe', 'retiro_soporte',
        'id_usuario_registro',
    ];

    protected $casts = [
        'fecha_nacimiento'    => 'date',
        'fecha_fallecimiento' => 'date',
        'fecha_deposito'      => 'date',
        'retiro_fecha'        => 'date',
    ];

    public function servicio(): BelongsTo
    {
        return $this->belongsTo(Servicio::class, 'id_servicio', 'id_servicio');
    }

    public function cenizario(): BelongsTo
    {
        return $this->belongsTo(Cenizario::class, 'id_cenizario', 'id_cenizario');
    }

    public function usuarioRegistro(): BelongsTo
    {
        return $this->belongsTo(Usuario::class, 'id_usuario_registro', 'id_usuario');
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Ubicacion extends Model
{
    protected $table = 't_ubicacion';
    protected $primaryKey = 'id_ubicacion';
    public $timestamps = false;

    protected $fillable = [
        'codigo', 'sector', 'posicion', 'capacidad', 'estado',
        'id_cliente_reserva', 'fecha_limite_reserva', 'estado_registro',
    ];

    protected $casts = [
        'capacidad'            => 'integer',
        'fecha_limite_reserva' => 'date',
    ];

    public function clienteReserva(): BelongsTo
    {
        return $this->belongsTo(Cliente::class, 'id_cliente_reserva', 'id_cliente');
    }

    public function cenizarios(): HasMany
    {
        return $this->hasMany(Cenizario::class, 'id_ubicacion', 'id_ubicacion');
    }

    public function servicios(): HasMany
    {
        return $this->hasMany(Servicio::class, 'id_ubicacion', 'id_ubicacion');
    }

    public function mantenimientos(): HasMany
    {
        return $this->hasMany(Mantenimiento::class, 'id_ubicacion', 'id_ubicacion');
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Cliente extends Model
{
    protected $table = 't_cliente';
    protected $primaryKey = 'id_cliente';
    public $timestamps = false;

    protected $fillable = [
        'tipo_identificacion', 'numero_identificacion', 'nombres', 'apellidos',
        'telefono', 'whatsapp', 'correo', 'direccion', 'estado',
    ];

    public function servicios(): HasMany
    {
        return $this->hasMany(Servicio::class, 'id_cliente', 'id_cliente');
    }

    public function ubicacionesReservadas(): HasMany
    {
        return $this->hasMany(Ubicacion::class, 'id_cliente_reserva', 'id_cliente');
    }
}

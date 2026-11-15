<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class TipoPago extends Model
{
    protected $table = 't_tipo_pago';
    protected $primaryKey = 'id_tipo_pago';
    public $timestamps = false;

    protected $fillable = ['nombre', 'descripcion', 'estado'];

    public function pagos(): HasMany
    {
        return $this->hasMany(Pago::class, 'id_tipo_pago', 'id_tipo_pago');
    }
}

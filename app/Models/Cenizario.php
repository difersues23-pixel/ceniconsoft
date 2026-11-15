<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Cenizario extends Model
{
    protected $table = 't_cenizario';
    protected $primaryKey = 'id_cenizario';
    public $timestamps = false;

    protected $fillable = ['codigo', 'id_ubicacion', 'numero_cupo', 'estado', 'id_servicio'];

    protected $casts = ['numero_cupo' => 'integer'];

    public function ubicacion(): BelongsTo
    {
        return $this->belongsTo(Ubicacion::class, 'id_ubicacion', 'id_ubicacion');
    }

    public function servicio(): BelongsTo
    {
        return $this->belongsTo(Servicio::class, 'id_servicio', 'id_servicio');
    }

    public function fallecidos(): HasMany
    {
        return $this->hasMany(Fallecido::class, 'id_cenizario', 'id_cenizario');
    }
}

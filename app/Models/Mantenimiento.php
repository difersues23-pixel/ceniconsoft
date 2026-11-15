<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Mantenimiento extends Model
{
    protected $table = 't_mantenimiento';
    protected $primaryKey = 'id_mantenimiento';
    public $timestamps = false;

    // anio_jornada es una columna generada (stored): NO va en $fillable.
    protected $fillable = [
        'id_ubicacion', 'tipo', 'fecha_programada', 'fecha_realizacion',
        'responsable', 'observaciones', 'estado',
    ];

    protected $casts = [
        'fecha_programada'  => 'date',
        'fecha_realizacion' => 'date',
        'anio_jornada'      => 'integer',
    ];

    public function ubicacion(): BelongsTo
    {
        return $this->belongsTo(Ubicacion::class, 'id_ubicacion', 'id_ubicacion');
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Model;

class Auditoria extends Model
{
    protected $table = 't_auditoria';
    protected $primaryKey = 'id_auditoria';
    public $timestamps = false;

    protected $fillable = [
        'id_usuario', 'rol', 'fecha_hora', 'accion', 'modulo', 'tabla_afectada',
        'id_registro_afectado', 'valor_anterior', 'valor_nuevo', 'motivo', 'canal', 'origen',
    ];

    protected $casts = ['fecha_hora' => 'datetime'];

    public function usuario(): BelongsTo
    {
        return $this->belongsTo(Usuario::class, 'id_usuario', 'id_usuario');
    }
}

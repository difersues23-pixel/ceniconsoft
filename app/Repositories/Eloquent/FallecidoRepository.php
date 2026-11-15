<?php

namespace App\Repositories\Eloquent;

use App\Models\Fallecido;
use App\Repositories\Contracts\FallecidoRepositoryInterface;
use App\Repositories\Eloquent\Concerns\ConEstado;
use App\Repositories\Eloquent\Concerns\PorIdentificacion;
use Carbon\Carbon;
use Illuminate\Support\Collection;

class FallecidoRepository extends BaseRepository implements FallecidoRepositoryInterface
{
    use ConEstado, PorIdentificacion;

    public function __construct(Fallecido $model)
    {
        parent::__construct($model);
    }

    public function porServicio(int $idServicio): Collection
    {
        return $this->model->newQuery()->where('id_servicio', $idServicio)->get();
    }

    public function enUbicacion(): Collection
    {
        return $this->porEstado('En ubicación');
    }

    public function registrarRetiro(
        int $id,
        string $tipo,
        Carbon $fecha,
        string $motivo,
        string $recibe,
        string $soporte
    ): Fallecido {
        return $this->actualizar($id, [
            'estado'         => 'Retirado',
            'retiro_tipo'    => $tipo,
            'retiro_fecha'   => $fecha,
            'retiro_motivo'  => $motivo,
            'retiro_recibe'  => $recibe,
            'retiro_soporte' => $soporte,
        ]);
    }
}

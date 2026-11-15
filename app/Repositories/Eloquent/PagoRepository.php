<?php

namespace App\Repositories\Eloquent;

use App\Models\Pago;
use App\Repositories\Contracts\PagoRepositoryInterface;
use App\Repositories\Eloquent\Concerns\ConEstado;
use Carbon\Carbon;
use Illuminate\Support\Collection;

class PagoRepository extends BaseRepository implements PagoRepositoryInterface
{
    use ConEstado;

    public function __construct(Pago $model)
    {
        parent::__construct($model);
    }

    public function porServicio(int $idServicio): Collection
    {
        return $this->model->newQuery()->where('id_servicio', $idServicio)->get();
    }

    public function enMora(): Collection
    {
        return $this->porEstado('Mora');
    }

    public function pendientesVencidos(Carbon $hoy): Collection
    {
        return $this->model->newQuery()
            ->where('estado', 'Pendiente')
            ->whereDate('fecha_vencimiento', '<', $hoy)
            ->get();
    }

    public function registrarPago(int $id, int $idTipoPago, Carbon $fechaPago): Pago
    {
        return $this->actualizar($id, [
            'estado'       => 'Pagado',
            'id_tipo_pago' => $idTipoPago,
            'fecha_pago'   => $fechaPago,
        ]);
    }

    public function anular(int $id): Pago
    {
        return $this->cambiarEstado($id, 'Anulado');
    }
}

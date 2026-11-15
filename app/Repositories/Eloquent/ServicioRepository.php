<?php

namespace App\Repositories\Eloquent;

use App\Models\Servicio;
use App\Repositories\Contracts\ServicioRepositoryInterface;
use App\Repositories\Eloquent\Concerns\ConEstado;
use Carbon\Carbon;
use Illuminate\Support\Collection;

class ServicioRepository extends BaseRepository implements ServicioRepositoryInterface
{
    use ConEstado;

    public function __construct(Servicio $model)
    {
        parent::__construct($model);
    }

    public function porCliente(int $idCliente): Collection
    {
        return $this->model->newQuery()->where('id_cliente', $idCliente)->get();
    }

    public function activosPorCliente(int $idCliente): Collection
    {
        return $this->model->newQuery()
            ->where('id_cliente', $idCliente)
            ->where('estado', 'Activo')
            ->get();
    }

    public function cerrar(int $id, string $estado, Carbon $fechaFin, string $motivo): Servicio
    {
        return $this->actualizar($id, [
            'estado'     => $estado,
            'fecha_fin'  => $fechaFin,
            'motivo_fin' => $motivo,
        ]);
    }
}

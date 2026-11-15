<?php

namespace App\Repositories\Contracts;

use App\Models\Servicio;
use App\Repositories\Contracts\Especiales\EstadoRepositoryInterface;
use Carbon\Carbon;
use Illuminate\Support\Collection;

interface ServicioRepositoryInterface extends EstadoRepositoryInterface
{
    public function porCliente(int $idCliente): Collection;

    public function activosPorCliente(int $idCliente): Collection;

    /** $estado: 'Cancelado' o 'Finalizado' (exige fecha y motivo por el CHECK de la BD). */
    public function cerrar(int $id, string $estado, Carbon $fechaFin, string $motivo): Servicio;
}

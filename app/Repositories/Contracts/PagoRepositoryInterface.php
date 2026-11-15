<?php

namespace App\Repositories\Contracts;

use App\Models\Pago;
use App\Repositories\Contracts\Especiales\EstadoRepositoryInterface;
use Carbon\Carbon;
use Illuminate\Support\Collection;

interface PagoRepositoryInterface extends EstadoRepositoryInterface
{
    public function porServicio(int $idServicio): Collection;

    public function enMora(): Collection;

    public function pendientesVencidos(Carbon $hoy): Collection;

    public function registrarPago(int $id, int $idTipoPago, Carbon $fechaPago): Pago;

    public function anular(int $id): Pago;
}

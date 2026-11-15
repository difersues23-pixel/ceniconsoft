<?php

namespace App\Repositories\Contracts;

use App\Models\Ubicacion;
use App\Repositories\Contracts\Especiales\EstadoRepositoryInterface;
use Carbon\Carbon;
use Illuminate\Support\Collection;

interface UbicacionRepositoryInterface extends EstadoRepositoryInterface
{
    public function buscarPorCodigo(string $codigo): ?Ubicacion;

    public function disponibles(): Collection;

    public function reservasVencidas(Carbon $hoy): Collection;

    public function reservar(int $id, int $idCliente, Carbon $fechaLimite): Ubicacion;

    public function liberarReserva(int $id): Ubicacion;
}

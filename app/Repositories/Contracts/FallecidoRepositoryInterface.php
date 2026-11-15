<?php

namespace App\Repositories\Contracts;

use App\Models\Fallecido;
use App\Repositories\Contracts\Especiales\EstadoRepositoryInterface;
use App\Repositories\Contracts\Especiales\IdentificableRepositoryInterface;
use Carbon\Carbon;
use Illuminate\Support\Collection;

interface FallecidoRepositoryInterface extends EstadoRepositoryInterface, IdentificableRepositoryInterface
{
    public function porServicio(int $idServicio): Collection;

    public function enUbicacion(): Collection;

    /** $tipo: 'Familia' o 'Mora'. */
    public function registrarRetiro(
        int $id,
        string $tipo,
        Carbon $fecha,
        string $motivo,
        string $recibe,
        string $soporte
    ): Fallecido;
}

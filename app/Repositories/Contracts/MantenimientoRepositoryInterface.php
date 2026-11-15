<?php

namespace App\Repositories\Contracts;

use App\Models\Mantenimiento;
use App\Repositories\Contracts\Especiales\EstadoRepositoryInterface;
use Carbon\Carbon;
use Illuminate\Support\Collection;

interface MantenimientoRepositoryInterface extends EstadoRepositoryInterface
{
    public function porUbicacion(int $idUbicacion): Collection;

    public function vencidos(Carbon $hoy): Collection;

    public function marcarRealizado(int $id, Carbon $fecha, ?string $responsable = null, ?string $observaciones = null): Mantenimiento;
}

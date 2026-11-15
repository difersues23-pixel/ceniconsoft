<?php

namespace App\Repositories\Eloquent;

use App\Models\Mantenimiento;
use App\Repositories\Contracts\MantenimientoRepositoryInterface;
use App\Repositories\Eloquent\Concerns\ConEstado;
use Carbon\Carbon;
use Illuminate\Support\Collection;

class MantenimientoRepository extends BaseRepository implements MantenimientoRepositoryInterface
{
    use ConEstado;

    public function __construct(Mantenimiento $model)
    {
        parent::__construct($model);
    }

    public function porUbicacion(int $idUbicacion): Collection
    {
        return $this->model->newQuery()->where('id_ubicacion', $idUbicacion)->get();
    }

    public function vencidos(Carbon $hoy): Collection
    {
        return $this->model->newQuery()
            ->where('estado', 'Programado')
            ->whereDate('fecha_programada', '<', $hoy)
            ->get();
    }

    public function marcarRealizado(int $id, Carbon $fecha, ?string $responsable = null, ?string $observaciones = null): Mantenimiento
    {
        $datos = ['estado' => 'Realizado', 'fecha_realizacion' => $fecha];

        if ($responsable !== null) {
            $datos['responsable'] = $responsable;
        }
        if ($observaciones !== null) {
            $datos['observaciones'] = $observaciones;
        }

        return $this->actualizar($id, $datos);
    }
}

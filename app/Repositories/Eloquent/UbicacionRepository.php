<?php

namespace App\Repositories\Eloquent;

use App\Models\Ubicacion;
use App\Repositories\Contracts\UbicacionRepositoryInterface;
use App\Repositories\Eloquent\Concerns\ConEstado;
use Carbon\Carbon;
use Illuminate\Support\Collection;

class UbicacionRepository extends BaseRepository implements UbicacionRepositoryInterface
{
    use ConEstado;

    public function __construct(Ubicacion $model)
    {
        parent::__construct($model);
    }

    public function buscarPorCodigo(string $codigo): ?Ubicacion
    {
        return $this->model->newQuery()->where('codigo', $codigo)->first();
    }

    public function disponibles(): Collection
    {
        return $this->model->newQuery()
            ->where('estado', 'Disponible')
            ->where('estado_registro', 'Activo')
            ->get();
    }

    public function reservasVencidas(Carbon $hoy): Collection
    {
        return $this->model->newQuery()
            ->where('estado', 'Reservado')
            ->whereDate('fecha_limite_reserva', '<', $hoy)
            ->get();
    }

    public function reservar(int $id, int $idCliente, Carbon $fechaLimite): Ubicacion
    {
        return $this->actualizar($id, [
            'estado'               => 'Reservado',
            'id_cliente_reserva'   => $idCliente,
            'fecha_limite_reserva' => $fechaLimite,
        ]);
    }

    public function liberarReserva(int $id): Ubicacion
    {
        return $this->actualizar($id, [
            'estado'               => 'Disponible',
            'id_cliente_reserva'   => null,
            'fecha_limite_reserva' => null,
        ]);
    }
}

<?php

namespace App\Repositories\Eloquent;

use App\Models\Cliente;
use App\Repositories\Contracts\ClienteRepositoryInterface;
use App\Repositories\Eloquent\Concerns\ConEstado;
use App\Repositories\Eloquent\Concerns\PorIdentificacion;
use Illuminate\Support\Collection;

class ClienteRepository extends BaseRepository implements ClienteRepositoryInterface
{
    use ConEstado, PorIdentificacion;

    public function __construct(Cliente $model)
    {
        parent::__construct($model);
    }

    public function buscarPorTexto(string $texto): Collection
    {
        return $this->model->newQuery()
            ->where(function ($q) use ($texto) {
                $q->where('nombres', 'like', "%{$texto}%")
                  ->orWhere('apellidos', 'like', "%{$texto}%")
                  ->orWhere('numero_identificacion', 'like', "%{$texto}%");
            })
            ->get();
    }

    public function conServicios(int $id): ?Cliente
    {
        return $this->model->newQuery()->with('servicios')->find($id);
    }
}

<?php

namespace App\Repositories\Eloquent;

use App\Models\Cenizario;
use App\Repositories\Contracts\CenizarioRepositoryInterface;
use App\Repositories\Eloquent\Concerns\ConEstado;
use Illuminate\Support\Collection;

class CenizarioRepository extends BaseRepository implements CenizarioRepositoryInterface
{
    use ConEstado;

    public function __construct(Cenizario $model)
    {
        parent::__construct($model);
    }

    public function buscarPorCodigo(string $codigo): ?Cenizario
    {
        return $this->model->newQuery()->where('codigo', $codigo)->first();
    }

    public function disponiblesPorUbicacion(int $idUbicacion): Collection
    {
        return $this->model->newQuery()
            ->where('id_ubicacion', $idUbicacion)
            ->where('estado', 'Disponible')
            ->get();
    }

    public function ocupar(int $id, int $idServicio): Cenizario
    {
        return $this->actualizar($id, ['estado' => 'Ocupado', 'id_servicio' => $idServicio]);
    }

    public function liberar(int $id): Cenizario
    {
        return $this->actualizar($id, ['estado' => 'Disponible', 'id_servicio' => null]);
    }
}

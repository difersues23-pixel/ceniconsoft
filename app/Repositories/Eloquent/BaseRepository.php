<?php

namespace App\Repositories\Eloquent;

use App\Repositories\Contracts\RepositoryInterface;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;

abstract class BaseRepository implements RepositoryInterface
{
    public function __construct(protected Model $model)
    {
    }

    public function todos(array $columnas = ['*']): Collection
    {
        return $this->model->newQuery()->get($columnas);
    }

    public function buscar(int $id): ?Model
    {
        return $this->model->newQuery()->find($id);
    }

    public function buscarOFallar(int $id): Model
    {
        return $this->model->newQuery()->findOrFail($id);
    }

    public function buscarPor(string $campo, mixed $valor): ?Model
    {
        return $this->model->newQuery()->where($campo, $valor)->first();
    }

    public function donde(array $condiciones): Collection
    {
        return $this->model->newQuery()->where($condiciones)->get();
    }

    public function paginar(int $porPagina = 15): LengthAwarePaginator
    {
        return $this->model->newQuery()->paginate($porPagina);
    }

    public function crear(array $datos): Model
    {
        return $this->model->newQuery()->create($datos);
    }

    public function actualizar(int $id, array $datos): Model
    {
        $registro = $this->buscarOFallar($id);
        $registro->update($datos);

        return $registro->refresh();
    }

    public function eliminar(int $id): bool
    {
        return (bool) $this->buscarOFallar($id)->delete();
    }
}

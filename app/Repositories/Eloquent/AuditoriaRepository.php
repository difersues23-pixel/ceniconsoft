<?php

namespace App\Repositories\Eloquent;

use App\Models\Auditoria;
use App\Repositories\Contracts\AuditoriaRepositoryInterface;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;
use LogicException;

class AuditoriaRepository extends BaseRepository implements AuditoriaRepositoryInterface
{
    public function __construct(Auditoria $model)
    {
        parent::__construct($model);
    }

    public function registrar(array $datos): Auditoria
    {
        return $this->crear($datos);
    }

    public function porUsuario(int $idUsuario): Collection
    {
        return $this->model->newQuery()->where('id_usuario', $idUsuario)->latest('fecha_hora')->get();
    }

    public function porRegistro(string $tabla, int $idRegistro): Collection
    {
        return $this->model->newQuery()
            ->where('tabla_afectada', $tabla)
            ->where('id_registro_afectado', $idRegistro)
            ->latest('fecha_hora')
            ->get();
    }

    // La auditoría es de solo-inserción: no se edita ni se borra.
    public function actualizar(int $id, array $datos): Model
    {
        throw new LogicException('La auditoría no se puede modificar.');
    }

    public function eliminar(int $id): bool
    {
        throw new LogicException('La auditoría no se puede eliminar.');
    }
}

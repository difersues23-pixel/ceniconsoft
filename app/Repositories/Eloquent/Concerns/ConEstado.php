<?php

namespace App\Repositories\Eloquent\Concerns;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;

trait ConEstado
{
    public function porEstado(string $estado): Collection
    {
        return $this->model->newQuery()->where('estado', $estado)->get();
    }

    public function cambiarEstado(int $id, string $estado): Model
    {
        return $this->actualizar($id, ['estado' => $estado]);
    }
}

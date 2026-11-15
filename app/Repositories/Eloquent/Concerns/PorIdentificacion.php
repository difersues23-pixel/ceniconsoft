<?php

namespace App\Repositories\Eloquent\Concerns;

use Illuminate\Database\Eloquent\Model;

trait PorIdentificacion
{
    public function buscarPorIdentificacion(string $numero): ?Model
    {
        return $this->model->newQuery()->where('numero_identificacion', $numero)->first();
    }
}

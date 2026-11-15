<?php

namespace App\Repositories\Contracts\Especiales;

use App\Repositories\Contracts\RepositoryInterface;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;

/**
 * Especial: tablas con columna "estado" (enum).
 */
interface EstadoRepositoryInterface extends RepositoryInterface
{
    public function porEstado(string $estado): Collection;

    public function cambiarEstado(int $id, string $estado): Model;
}

<?php

namespace App\Repositories\Contracts\Especiales;

use App\Repositories\Contracts\RepositoryInterface;
use Illuminate\Database\Eloquent\Model;

/**
 * Especial: tablas con "numero_identificacion" único (cliente, fallecido).
 */
interface IdentificableRepositoryInterface extends RepositoryInterface
{
    public function buscarPorIdentificacion(string $numero): ?Model;
}

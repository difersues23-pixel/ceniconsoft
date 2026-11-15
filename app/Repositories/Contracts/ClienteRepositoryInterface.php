<?php

namespace App\Repositories\Contracts;

use App\Models\Cliente;
use App\Repositories\Contracts\Especiales\EstadoRepositoryInterface;
use App\Repositories\Contracts\Especiales\IdentificableRepositoryInterface;
use Illuminate\Support\Collection;

interface ClienteRepositoryInterface extends EstadoRepositoryInterface, IdentificableRepositoryInterface
{
    public function buscarPorTexto(string $texto): Collection;

    public function conServicios(int $id): ?Cliente;
}

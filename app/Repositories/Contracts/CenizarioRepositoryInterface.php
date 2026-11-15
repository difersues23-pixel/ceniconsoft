<?php

namespace App\Repositories\Contracts;

use App\Models\Cenizario;
use App\Repositories\Contracts\Especiales\EstadoRepositoryInterface;
use Illuminate\Support\Collection;

interface CenizarioRepositoryInterface extends EstadoRepositoryInterface
{
    public function buscarPorCodigo(string $codigo): ?Cenizario;

    public function disponiblesPorUbicacion(int $idUbicacion): Collection;

    public function ocupar(int $id, int $idServicio): Cenizario;

    public function liberar(int $id): Cenizario;
}

<?php

namespace App\Repositories\Contracts;

use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;

/**
 * Interfaz genérica (CRUD). Todas las interfaces de tabla descienden de ella.
 */
interface RepositoryInterface
{
    public function todos(array $columnas = ['*']): Collection;

    public function buscar(int $id): ?Model;

    public function buscarOFallar(int $id): Model;

    public function buscarPor(string $campo, mixed $valor): ?Model;

    public function donde(array $condiciones): Collection;

    public function paginar(int $porPagina = 15): LengthAwarePaginator;

    public function crear(array $datos): Model;

    public function actualizar(int $id, array $datos): Model;

    public function eliminar(int $id): bool;
}

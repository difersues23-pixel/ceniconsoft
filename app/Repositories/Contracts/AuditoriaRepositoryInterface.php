<?php

namespace App\Repositories\Contracts;

use App\Models\Auditoria;
use Illuminate\Support\Collection;

interface AuditoriaRepositoryInterface extends RepositoryInterface
{
    public function registrar(array $datos): Auditoria;

    public function porUsuario(int $idUsuario): Collection;

    public function porRegistro(string $tabla, int $idRegistro): Collection;
}

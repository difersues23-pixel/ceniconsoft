<?php

namespace App\Repositories\Contracts;

use App\Models\Usuario;
use App\Repositories\Contracts\Especiales\EstadoRepositoryInterface;
use Carbon\Carbon;

interface UsuarioRepositoryInterface extends EstadoRepositoryInterface
{
    public function buscarPorNombreUsuario(string $nombreUsuario): ?Usuario;

    public function registrarIntentoFallido(int $id): Usuario;

    public function reiniciarIntentos(int $id): Usuario;

    public function bloquear(int $id, Carbon $inicio, Carbon $fin): Usuario;

    public function desbloquear(int $id): Usuario;
}

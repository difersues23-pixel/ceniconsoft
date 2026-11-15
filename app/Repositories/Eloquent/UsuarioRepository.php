<?php

namespace App\Repositories\Eloquent;

use App\Models\Usuario;
use App\Repositories\Contracts\UsuarioRepositoryInterface;
use App\Repositories\Eloquent\Concerns\ConEstado;
use Carbon\Carbon;

class UsuarioRepository extends BaseRepository implements UsuarioRepositoryInterface
{
    use ConEstado;

    public function __construct(Usuario $model)
    {
        parent::__construct($model);
    }

    public function buscarPorNombreUsuario(string $nombreUsuario): ?Usuario
    {
        return $this->model->newQuery()->where('nombre_usuario', $nombreUsuario)->first();
    }

    public function registrarIntentoFallido(int $id): Usuario
    {
        $usuario = $this->buscarOFallar($id);
        $usuario->increment('intentos_fallidos');

        return $usuario->refresh();
    }

    public function reiniciarIntentos(int $id): Usuario
    {
        return $this->actualizar($id, ['intentos_fallidos' => 0]);
    }

    public function bloquear(int $id, Carbon $inicio, Carbon $fin): Usuario
    {
        return $this->actualizar($id, [
            'estado'               => 'Bloqueado',
            'fecha_bloqueo_inicio' => $inicio,
            'fecha_bloqueo_fin'    => $fin,
        ]);
    }

    public function desbloquear(int $id): Usuario
    {
        return $this->actualizar($id, [
            'estado'               => 'Activo',
            'intentos_fallidos'    => 0,
            'fecha_bloqueo_inicio' => null,
            'fecha_bloqueo_fin'    => null,
        ]);
    }
}

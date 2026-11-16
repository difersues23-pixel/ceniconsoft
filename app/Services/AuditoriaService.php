<?php

namespace App\Services;

use App\Exceptions\ReglaNegocioException;
use App\Models\Auditoria;
use App\Repositories\Contracts\AuditoriaRepositoryInterface;
use App\Support\Rol;
use App\Support\Sesion;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;

/**
 * MOD-USU · Auditoría (t_auditoria).
 * Solo se inserta y se consulta: nunca se modifica ni se elimina (RN-039).
 */
class AuditoriaService
{
    public function __construct(private AuditoriaRepositoryInterface $auditorias)
    {
    }

    /** Lo llaman todos los demás Services (directamente o mediante auditar()). */
    public function registrarAccion(array $dto): Auditoria
    {
        foreach (['accion', 'modulo'] as $campo) {
            if (empty($dto[$campo])) {
                throw new ReglaNegocioException('Acción y módulo son obligatorios');
            }
        }

        $usuario = Sesion::usuario();

        /** @var Auditoria $registro */
        $registro = $this->auditorias->create([
            'id_usuario'           => $usuario?->id_usuario,           // null = "Sistema"
            'rol'                  => $usuario?->rol ?? 'Sistema',
            'fecha_hora'           => now(),
            'accion'               => $dto['accion'],
            'modulo'               => $dto['modulo'],
            'tabla_afectada'       => $dto['tabla_afectada'] ?? null,
            'id_registro_afectado' => $dto['id_registro_afectado'] ?? null,
            'valor_anterior'       => $this->serializar($dto['valor_anterior'] ?? null),
            'valor_nuevo'          => $this->serializar($dto['valor_nuevo'] ?? null),
            'motivo'               => $dto['motivo'] ?? null,
            'canal'                => $dto['canal'] ?? null,
            'origen'               => $dto['origen'] ?? ($usuario ? 'Web' : 'Sistema'),
        ]);

        return $registro;
    }

    /** Atajo para los demás Services. */
    public function auditar(
        string $accion,
        string $modulo,
        ?string $tabla = null,
        ?int $idRegistro = null,
        mixed $anterior = null,
        mixed $nuevo = null,
        ?string $motivo = null,
        ?string $canal = null,
        ?string $origen = null,
    ): Auditoria {
        return $this->registrarAccion([
            'accion'               => $accion,
            'modulo'               => $modulo,
            'tabla_afectada'       => $tabla,
            'id_registro_afectado' => $idRegistro,
            'valor_anterior'       => $anterior,
            'valor_nuevo'          => $nuevo,
            'motivo'               => $motivo,
            'canal'                => $canal,
            'origen'               => $origen,
        ]);
    }

    /** Solo el administrador. Colección vacía = "No hay registros de auditoría". */
    public function consultarAuditoria(array $filtro = []): Collection
    {
        Sesion::exigirRol(Rol::ADMINISTRADOR);
        return $this->auditorias->buscar($filtro);
    }

    /** Convierte modelos o arreglos a texto, sin contraseñas. */
    private function serializar(mixed $valor): ?string
    {
        if ($valor === null) {
            return null;
        }
        if ($valor instanceof Model) {
            $valor = $valor->makeHidden(['contrasena'])->toArray();
        }
        if (is_array($valor)) {
            unset($valor['contrasena']);
            return json_encode($valor, JSON_UNESCAPED_UNICODE);
        }
        return (string) $valor;
    }
}

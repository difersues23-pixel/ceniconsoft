<?php

namespace App\Contracts;

/** Componente externo "Almacenamiento en la nube" (copias de seguridad). */
interface RespaldoInterface
{
    public function guardarEnNube(string $nombre, string $contenido): bool;
    public function descargar(string $nombre): string;
}

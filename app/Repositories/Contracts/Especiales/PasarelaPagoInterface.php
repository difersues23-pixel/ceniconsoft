<?php

namespace App\Contracts;

/** Componente externo "Pasarela de Pagos" (PSE / tarjeta). */
interface PasarelaPagoInterface
{
    public function generarEnlace(int $idPago): string;

    /** @return array{resultado: string} resultado = aprobada | rechazada | pendiente */
    public function procesar(array $transaccion): array;
}

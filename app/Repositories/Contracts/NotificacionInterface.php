<?php

namespace App\Contracts;

use App\Models\Cliente;

/** Componente externo "Servicio de Notificaciones" (Email / WhatsApp / SMS). */
interface NotificacionInterface
{
    public function enviar(string $canal, Cliente $cliente, string $mensaje): void;   // 'Email' | 'WhatsApp'
    public function enviarSms(Cliente $cliente, string $mensaje): void;
}

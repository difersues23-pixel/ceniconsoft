<?php

namespace App\Services\Login;

use App\Exceptions\AccesoDenegadoException;
use App\Models\Usuario;
use Illuminate\Support\Facades\Auth;

/** Acceso al usuario autenticado (el "ACTOR" del pseudocódigo). */
final class Sesion
{
    public static function usuario(): ?Usuario
    {
        /** @var Usuario|null $u */
        $u = Auth::user();
        return $u;
    }

    public static function id(): ?int
    {
        return self::usuario()?->id_usuario;
    }

    public static function rol(): ?string
    {
        return self::usuario()?->rol;
    }

    /**
     * La suplente no modifica datos sin autorización de la secretaria a cargo (RN-034).
     * Ejemplo de uso: el Controller pone session(['autorizacion_secretaria' => true]) tras validar a la secretaria.
     */
    public static function autorizacionSecretaria(): bool
    {
        return (bool) session('autorizacion_secretaria', false);
    }

    public static function exigirAutenticado(): void
    {
        if (!self::usuario()) {
            throw new AccesoDenegadoException('Debe iniciar sesión');
        }
    }

    public static function exigirRol(string ...$roles): void
    {
        self::exigirAutenticado();
        if (!in_array(self::rol(), $roles, true)) {
            throw new AccesoDenegadoException('Acceso denegado para su rol');
        }
    }
}

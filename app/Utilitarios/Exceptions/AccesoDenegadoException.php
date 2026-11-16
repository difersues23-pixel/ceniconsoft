<?php

namespace App\Exceptions;

use DomainException;
use Illuminate\Http\JsonResponse;

/** Se lanza cuando el rol del usuario no puede ejecutar la acción (HTTP 403). */
class AccesoDenegadoException extends DomainException
{
    public function render(): JsonResponse
    {
        return response()->json(['error' => $this->getMessage()], 403);
    }
}

<?php

namespace App\Contracts;

interface GeneradorPdfInterface
{
    /** Devuelve el PDF como cadena binaria. */
    public function generar(string $titulo, array $datos): string;
}

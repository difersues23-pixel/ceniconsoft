<?php

namespace App\Repositories\Contracts;

use App\Repositories\Contracts\Especiales\EstadoRepositoryInterface;
use Illuminate\Support\Collection;

interface TipoPagoRepositoryInterface extends EstadoRepositoryInterface
{
    public function habilitados(): Collection;
}

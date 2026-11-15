<?php

namespace App\Repositories\Eloquent;

use App\Models\TipoPago;
use App\Repositories\Contracts\TipoPagoRepositoryInterface;
use App\Repositories\Eloquent\Concerns\ConEstado;
use Illuminate\Support\Collection;

class TipoPagoRepository extends BaseRepository implements TipoPagoRepositoryInterface
{
    use ConEstado;

    public function __construct(TipoPago $model)
    {
        parent::__construct($model);
    }

    public function habilitados(): Collection
    {
        return $this->porEstado('Habilitado');
    }
}

<?php

namespace App\Providers;

use App\Repositories\Contracts\AuditoriaRepositoryInterface;
use App\Repositories\Contracts\CenizarioRepositoryInterface;
use App\Repositories\Contracts\ClienteRepositoryInterface;
use App\Repositories\Contracts\FallecidoRepositoryInterface;
use App\Repositories\Contracts\MantenimientoRepositoryInterface;
use App\Repositories\Contracts\PagoRepositoryInterface;
use App\Repositories\Contracts\ServicioRepositoryInterface;
use App\Repositories\Contracts\TipoPagoRepositoryInterface;
use App\Repositories\Contracts\UbicacionRepositoryInterface;
use App\Repositories\Contracts\UsuarioRepositoryInterface;
use App\Repositories\Eloquent\AuditoriaRepository;
use App\Repositories\Eloquent\CenizarioRepository;
use App\Repositories\Eloquent\ClienteRepository;
use App\Repositories\Eloquent\FallecidoRepository;
use App\Repositories\Eloquent\MantenimientoRepository;
use App\Repositories\Eloquent\PagoRepository;
use App\Repositories\Eloquent\ServicioRepository;
use App\Repositories\Eloquent\TipoPagoRepository;
use App\Repositories\Eloquent\UbicacionRepository;
use App\Repositories\Eloquent\UsuarioRepository;
use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    public array $bindings = [
        UsuarioRepositoryInterface::class       => UsuarioRepository::class,
        ClienteRepositoryInterface::class       => ClienteRepository::class,
        UbicacionRepositoryInterface::class     => UbicacionRepository::class,
        TipoPagoRepositoryInterface::class      => TipoPagoRepository::class,
        ServicioRepositoryInterface::class      => ServicioRepository::class,
        CenizarioRepositoryInterface::class     => CenizarioRepository::class,
        FallecidoRepositoryInterface::class     => FallecidoRepository::class,
        PagoRepositoryInterface::class          => PagoRepository::class,
        MantenimientoRepositoryInterface::class => MantenimientoRepository::class,
        AuditoriaRepositoryInterface::class     => AuditoriaRepository::class,
    ];
}

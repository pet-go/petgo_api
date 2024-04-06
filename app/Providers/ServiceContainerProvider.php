<?php

namespace App\Providers;

use App\Modules\Clientes\Contracts\ClienteContract;
use App\Modules\Clientes\Services\BuscarCliente;
use Illuminate\Support\ServiceProvider;

class ServiceContainerProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->bind(BuscarCliente::class, function ($app) {
            return new BuscarCliente(
                $app->make(ClienteContract::class)
            );
        });
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}

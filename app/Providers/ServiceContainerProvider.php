<?php

namespace App\Providers;

use App\Modules\Clientes\Contracts\BuscarClienteContract;
use App\Modules\Clientes\Contracts\CadastrarClienteContrat;
use App\Modules\Clientes\Services\ClienteService;
use App\Modules\Pets\Contracts\BuscarPetContract;
use App\Modules\Pets\Services\PetService;
use Illuminate\Support\ServiceProvider;

class ServiceContainerProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->bind(ClienteService::class, function ($app) {
            return new ClienteService(
                $app->make(BuscarClienteContract::class),
                $app->make(CadastrarClienteContrat::class)
            );
        });
        $this->app->bind(PetService::class, function ($app) {
            return new PetService(
                $app->make(BuscarPetContract::class),
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

<?php

namespace App\Providers;

use App\Modules\Clientes\Contracts\AtualizarClienteContract;
use App\Modules\Clientes\Contracts\BuscarClienteContract;
use App\Modules\Clientes\Contracts\CadastrarClienteContrat;
use App\Modules\Clientes\Contracts\ExibirClienteContract;
use App\Modules\Clientes\Contracts\RemoverClienteContract;
use App\Modules\Clientes\Services\ClienteService;
use App\Modules\Pets\Contracts\AtualizarPetContract;
use App\Modules\Pets\Contracts\BuscarPetContract;
use App\Modules\Pets\Contracts\CadastrarPetContract;
use App\Modules\Pets\Contracts\ExibirPetContract;
use App\Modules\Pets\Contracts\RemoverPetContract;
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
                $app->make(ExibirClienteContract::class),
                $app->make(CadastrarClienteContrat::class),
                $app->make(AtualizarClienteContract::class),
                $app->make(RemoverClienteContract::class),
            );
        });
        $this->app->bind(PetService::class, function ($app) {
            return new PetService(
                $app->make(CadastrarPetContract::class),
                $app->make(BuscarPetContract::class),
                $app->make(ExibirPetContract::class),
                $app->make(AtualizarPetContract::class),
                $app->make(RemoverPetContract::class)
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

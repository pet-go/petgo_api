<?php

namespace App\Providers;

use App\Modules\Clientes\Contracts\BuscarClienteContract;
use App\Modules\Clientes\Contracts\CadastrarClienteContrat;
use App\Modules\Clientes\Repositories\BuscarClienteRepository;
use App\Modules\Clientes\Repositories\CadastrarClienteRepository;
use App\Modules\Pets\Contracts\BuscarPetContract;
use App\Modules\Pets\Repositories\BuscarPetRepository;
use Illuminate\Support\ServiceProvider;

class RepositoryProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->bind(BuscarClienteContract::class, BuscarClienteRepository::class);
        $this->app->bind(CadastrarClienteContrat::class, CadastrarClienteRepository::class);
        $this->app->bind(BuscarPetContract::class, BuscarPetRepository::class);
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}

<?php

namespace App\Providers;

use App\Modules\Clientes\Contracts\BuscarClienteContract;
use App\Modules\Clientes\Contracts\CadastrarClienteContrat;
use App\Modules\Clientes\Repositories\BuscarClienteRepository;
use App\Modules\Clientes\Repositories\CadastrarClienteRepository;
use App\Modules\Pets\Contracts\AtualizarPetContract;
use App\Modules\Pets\Contracts\BuscarPetContract;
use App\Modules\Pets\Contracts\CadastrarPetContract;
use App\Modules\Pets\Contracts\ExibirPetContract;
use App\Modules\Pets\Contracts\RemoverPetContract;
use App\Modules\Pets\Repositories\AtualizarPetRepository;
use App\Modules\Pets\Repositories\BuscarPetRepository;
use App\Modules\Pets\Repositories\CadastrarPetRepository;
use App\Modules\Pets\Repositories\ExibirPetRepository;
use App\Modules\Pets\Repositories\RemoverPetRepository;
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
        $this->app->bind(CadastrarPetContract::class, CadastrarPetRepository::class);
        $this->app->bind(BuscarPetContract::class, BuscarPetRepository::class);
        $this->app->bind(ExibirPetContract::class, ExibirPetRepository::class);
        $this->app->bind(AtualizarPetContract::class, AtualizarPetRepository::class);
        $this->app->bind(RemoverPetContract::class, RemoverPetRepository::class);
    }
    
    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}

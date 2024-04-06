<?php

namespace App\Providers;

use App\Modules\Clientes\Contracts\ClienteContract;
use App\Modules\Clientes\Repositories\ClienteRepository;
use Illuminate\Support\ServiceProvider;

class RepositoryProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->bind(ClienteContract::class, ClienteRepository::class);
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}

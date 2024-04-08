<?php

use App\Http\Middleware\JwtMiddleware;
use App\Modules\Clientes\Controllers\ClientesController;
use Illuminate\Support\Facades\Route;

Route::middleware(JwtMiddleware::class)
    ->prefix('v1')
    ->group(function ($router) {
        $router->get('/', function () {
            return 'Home';
        });
    });

Route::prefix('v1')->group(
    function ($router) {
        $router->controller(ClientesController::class)->group(
            function ($cliente) {
                $cliente->get('clientes', 'index');
            }
        );
    }
);
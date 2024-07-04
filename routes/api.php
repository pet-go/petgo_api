<?php

use App\Http\Middleware\JwtMiddleware;
use App\Modules\Auth\Controllers\AuthController;
use App\Modules\Clientes\Controllers\ClientesController;
use App\Modules\Pets\Controllers\PetsController;
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
                $cliente->post('clientes', 'store');
                $cliente->get('clientes/{id}', 'show');
                $cliente->put('clientes/{id}', 'update');
                $cliente->delete('clientes/{id}', 'destroy');
            }
        );
        $router->controller(PetsController::class)->group(
            function ($pet) {
                $pet->get('pets', 'index');
                $pet->post('pets', 'store');
                $pet->get('pets/{id}', 'show');
                $pet->put('pets/{id}', 'update');
                $pet->delete('pets/{id}', 'destroy');
            }
        );
        $router->controller(AuthController::class)->group(
            function ($auth) {
                $auth->post('auth-cliente/{cliente}', 'cadastrar');
            }
        );
    }
);

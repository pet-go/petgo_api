<?php

use App\Http\Middleware\JwtMiddleware;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::middleware(JwtMiddleware::class)
    ->prefix('v1')
    ->group(function ($router) {
        $router->get('/', function() {
            return 'Home';
        });
    });

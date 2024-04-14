<?php

declare(strict_types=1);

namespace App\Modules\Clientes\Controllers;

use App\Models\Cliente\Cliente;
use App\Modules\Clientes\Services\BuscarCliente;
use App\Traits\CrudControllerTrait;

class ClientesController
{
    use CrudControllerTrait;

    public function __construct(
        private readonly BuscarCliente $servicoBuscar,
        private readonly Cliente $model
    ) {
    }
}

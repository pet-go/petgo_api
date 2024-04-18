<?php

declare(strict_types=1);

namespace App\Modules\Clientes\Controllers;

use App\Models\Cliente\Cliente;
use App\Modules\Clientes\Services\ClienteService;
use App\Modules\Clientes\Validations\ClienteValidation;
use App\Traits\CrudControllerTrait;

class ClientesController
{
    use CrudControllerTrait;

    public function __construct(
        private readonly ClienteService $servico,
        private readonly Cliente $model
    ) {
    }
}

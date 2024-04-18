<?php

declare(strict_types= 1);

namespace App\Modules\Clientes\Repositories;

use App\Models\Cliente\Cliente;
use App\Modules\Clientes\Contracts\CadastrarClienteContrat;
use App\Modules\Clientes\Resources\ClienteCollection;
use App\Traits\CrudRepositoryTrait;

class CadastrarClienteRepository implements CadastrarClienteContrat
{
    use CrudRepositoryTrait;

    protected mixed $modelo = Cliente::class;
    protected mixed $resourceCollection = ClienteCollection::class;
}
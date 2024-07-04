<?php

declare(strict_types=1);

namespace App\Modules\Clientes\Repositories;

use App\Models\Cliente\Cliente;
use App\Modules\Clientes\Contracts\BuscarClienteContract;
use App\Modules\Clientes\Resources\ClienteCollection;
use App\Traits\CrudRepositoryTrait;

class BuscarClienteRepository implements BuscarClienteContract
{
    use CrudRepositoryTrait;

     /** @var $resourceCollection */
     protected mixed $resourceCollection = ClienteCollection::class;
     protected mixed $modelo = Cliente::class;
    
}

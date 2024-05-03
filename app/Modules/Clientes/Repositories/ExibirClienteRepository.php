<?php

namespace App\Modules\Clientes\Repositories;
use App\Modules\Clientes\Contracts\ExibirClienteContract;
use App\Modules\Clientes\Resources\ClienteCollection;
use App\Traits\CrudRepositoryTrait;

class ExibirClienteRepository implements ExibirClienteContract
{
    use CrudRepositoryTrait;
    
    /** @var $resourceCollection */
    protected mixed $resourceCollection = ClienteCollection::class;
}

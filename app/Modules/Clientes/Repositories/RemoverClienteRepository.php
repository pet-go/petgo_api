<?php

namespace App\Modules\Clientes\Repositories;

use App\Modules\Clientes\Contracts\RemoverClienteContract;
use App\Modules\Clientes\Resources\ClienteCollection;
use App\Traits\CrudRepositoryTrait;

class RemoverClienteRepository implements RemoverClienteContract
{
    use CrudRepositoryTrait;

    /** @var mixed $resourceCollection */
    protected mixed $resourceCollection = ClienteCollection::class;
}

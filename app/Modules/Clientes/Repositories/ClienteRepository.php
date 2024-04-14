<?php

declare(strict_types=1);

namespace App\Modules\Clientes\Repositories;

use App\Modules\Clientes\Contracts\ClienteContract;
use App\Modules\Clientes\Resources\ClienteCollection;
use App\Traits\CrudRepositoryTrait;

class ClienteRepository implements ClienteContract
{
    use CrudRepositoryTrait;

     /** @var $resourceCollection */
     protected mixed $resourceCollection = ClienteCollection::class;
    
}

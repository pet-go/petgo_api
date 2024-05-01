<?php

namespace App\Modules\Clientes\Repositories;

use App\Modules\Clientes\Contracts\AtualizarClienteContract;
use App\Modules\Clientes\Resources\ClienteCollection;
use App\Modules\Clientes\Validations\ClienteValidation;
use App\Traits\CrudRepositoryTrait;

class AtualizarClienteRepository implements AtualizarClienteContract
{
    use CrudRepositoryTrait;
    
    protected mixed $resourceCollection = ClienteCollection::class;
    protected mixed $validations = ClienteValidation::class;
}

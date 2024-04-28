<?php

declare(strict_types= 1);

namespace App\Modules\Pets\Repositories;

use App\Modules\Pets\Contracts\BuscarPetContract;
use App\Modules\Pets\Resources\PetCollection;
use App\Traits\CrudRepositoryTrait;

class BuscarPetRepository implements BuscarPetContract
{
    use CrudRepositoryTrait;

     /** @var $resourceCollection */
     protected mixed $resourceCollection = PetCollection::class;
}

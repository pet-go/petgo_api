<?php

namespace App\Modules\Pets\Repositories;

use App\Modules\Pets\Contracts\RemoverPetContract;
use App\Modules\Pets\Resources\PetCollection;
use App\Traits\CrudRepositoryTrait;

class RemoverPetRepository implements RemoverPetContract
{
    use CrudRepositoryTrait;

    /** @var mixed $resourceCollection */
    protected mixed $resourceCollection = PetCollection::class;
}

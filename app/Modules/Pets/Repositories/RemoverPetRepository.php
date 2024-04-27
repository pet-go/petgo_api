<?php

namespace App\Modules\Pets\Repositories;

use App\Models\Pet\Pet;
use App\Modules\Pets\Contracts\RemoverPetContract;
use App\Modules\Pets\Resources\PetCollection;
use App\Traits\CrudRepositoryTrait;

class RemoverPetRepository implements RemoverPetContract
{
    use CrudRepositoryTrait;

    protected mixed $modelo = Pet::class;
    protected mixed $resourceCollection = PetCollection::class;
}

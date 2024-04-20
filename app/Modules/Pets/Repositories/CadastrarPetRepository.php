<?php

declare(strict_types= 1);

namespace App\Modules\Pets\Repositories;

use App\Models\Pet\Pet;
use App\Modules\Pets\Resources\PetCollection;
use App\Traits\CrudRepositoryTrait;

class CadastrarPetRepository
{
    use CrudRepositoryTrait;

    protected mixed $modelo = Pet::class;
    protected mixed $resourceCollection = PetCollection::class;
    //protected mixed $validations = PetValidation::class;
}

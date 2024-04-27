<?php

namespace App\Modules\Pets\Repositories;

use App\Models\Pet\Pet;
use App\Modules\Pets\Contracts\AtualizarPetContract;
use App\Modules\Pets\Resources\PetCollection;
use App\Modules\Pets\Validations\PetValidation;
use App\Traits\CrudRepositoryTrait;

class AtualizarPetRepository implements AtualizarPetContract
{
    use CrudRepositoryTrait;

    protected mixed $modelo = Pet::class;
    protected mixed $resourceCollection = PetCollection::class;
    protected mixed $validations = PetValidation::class;

}

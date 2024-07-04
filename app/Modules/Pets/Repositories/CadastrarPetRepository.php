<?php

declare(strict_types= 1);

namespace App\Modules\Pets\Repositories;

use App\Models\Pet\Pet;
use App\Modules\Pets\Contracts\CadastrarPetContract;
use App\Modules\Pets\Resources\PetCollection;
use App\Modules\Pets\Validations\PetValidation;
use App\Traits\CrudRepositoryTrait;

class CadastrarPetRepository implements CadastrarPetContract
{
    use CrudRepositoryTrait;
    protected mixed $resourceCollection = PetCollection::class;
    protected mixed $validations = PetValidation::class;
}

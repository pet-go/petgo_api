<?php
declare(strict_types=1);

namespace App\Modules\Pets\Repositories;
use App\Modules\Pets\Contracts\ExibirPetContract;
use App\Modules\Pets\Resources\PetCollection;
use App\Traits\CrudRepositoryTrait;

class ExibirPetRepository implements ExibirPetContract
{
    use CrudRepositoryTrait;
    
    /** @var $resourceCollection */
    protected mixed $resourceCollection = PetCollection::class;
}

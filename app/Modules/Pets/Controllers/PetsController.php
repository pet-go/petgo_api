<?php

declare(strict_types=1);

namespace App\Modules\Pets\Controllers;

use App\Models\Pet\Pet;
use App\Modules\Pets\Services\PetService;
use App\Traits\CrudControllerTrait;

class PetsController
{
    use CrudControllerTrait;

    public function __construct(
        private readonly PetService $servico,
        private readonly Pet $model
    ) {
    }
}

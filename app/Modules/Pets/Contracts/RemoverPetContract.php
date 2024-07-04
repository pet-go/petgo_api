<?php

declare(strict_types=1);

namespace App\Modules\Pets\Contracts;

use Exception;
use Illuminate\Database\Eloquent\Model;

interface RemoverPetContract
{
    /**
     * Exclui o registro pet
     * 
     * @param Model $pet
     * @return array
     * 
     * @throws Exception
     */
    public function remover(Model $pet): array;
}

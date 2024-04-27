<?php

declare(strict_types=1);

namespace App\Modules\Validations;

interface BaseValidation
{
    /**
     * Retorna os dados validados do request
     * 
     * @param array $dados
     * @return array
     */
    public function validator(array $dados): array;
}

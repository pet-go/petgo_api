<?php

namespace App\Modules\Pets\Contracts;

interface CadastrarPetContract
{
    /**
     * @param array<mixed> $dados
     * @return array>mixed>
     */
    public function cadastrar(array $dados): array;
}

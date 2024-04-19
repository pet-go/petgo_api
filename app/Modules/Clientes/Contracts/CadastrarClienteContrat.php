<?php

namespace App\Modules\Clientes\Contracts;

interface CadastrarClienteContrat
{
    /**
     * @param array<mixed> $dados
     * @return array>mixed>
     */
    public function cadastrar(array $dados): array;
}

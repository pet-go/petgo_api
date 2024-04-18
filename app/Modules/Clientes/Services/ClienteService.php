<?php

declare(strict_types=1);

namespace App\Modules\Clientes\Services;

use App\Modules\Clientes\Pipelines\PesquisarCliente;
use App\Modules\Clientes\Repositories\BuscarClienteRepository;
use App\Modules\Clientes\Repositories\CadastrarClienteRepository;
use App\Traits\CrudServiceTrait;

class ClienteService
{
    use CrudServiceTrait;

    /** @var $pesquisaPipeline */
    protected mixed $pesquisaPipeline = PesquisarCliente::class;

    public function __construct(
        private readonly BuscarClienteRepository $buscarRepository,
        private readonly CadastrarClienteRepository $cadastrarRepository
    ) {
    }
}

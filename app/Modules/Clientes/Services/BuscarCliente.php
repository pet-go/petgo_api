<?php

declare(strict_types=1);

namespace App\Modules\Clientes\Services;

use App\Modules\Clientes\Pipelines\PesquisarCliente;
use App\Modules\Clientes\Repositories\ClienteRepository;
use App\Traits\CrudServiceTrait;

class BuscarCliente
{
    use CrudServiceTrait;

    /** @var $pesquisaPipeline */
    protected mixed $pesquisaPipeline = PesquisarCliente::class;

    public function __construct(
        private readonly ClienteRepository $repository
    ) {
    }
}

<?php
declare(strict_types=1);

namespace App\Modules\Pets\Services;

use App\Modules\Pets\Pipelines\PesquisarPet;
use App\Modules\Pets\Repositories\PetRepository;
use App\Traits\CrudServiceTrait;


class BuscarPet
{
    use CrudServiceTrait;

    /** @var $pesquisarPipeline */
    protected mixed $pesquisaPipeline = PesquisarPet::class;
    
    public function __construct(
        private readonly PetRepository $repository
    )
    {}
}

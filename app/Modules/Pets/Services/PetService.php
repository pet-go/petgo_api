<?php

namespace App\Modules\Pets\Services;

use App\Modules\Clientes\Pipelines\PesquisarPet;
use App\Modules\Pets\Repositories\AtualizarPetRepository;
use App\Modules\Pets\Repositories\BuscarPetRepository;
use App\Modules\Pets\Repositories\CadastrarPetRepository;
use App\Modules\Pets\Repositories\ExibirPetRepository;
use App\Modules\Pets\Repositories\RemoverPetRepository;
use App\Traits\CrudServiceTrait;

class PetService
{
    use CrudServiceTrait;

    /** @var $pesquisaPipeline */
    protected mixed $pesquisaPipeline = PesquisarPet::class;

    public function __construct(
        private readonly CadastrarPetRepository $cadastrarRepository,
        private readonly BuscarPetRepository $buscarRepository,
        private readonly ExibirPetRepository $exibirRepository,
        private readonly AtualizarPetRepository $atualizarRepository,
        private readonly RemoverPetRepository $removerRepository
    ) {
    }
}

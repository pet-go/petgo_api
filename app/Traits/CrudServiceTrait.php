<?php

namespace App\Traits;

use App\Modules\Filtros\FiltrarId;
use Exception;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Pipeline\Pipeline;

trait CrudServiceTrait
{
    /**
     * Serviço retorna uma lista filtrada.
     * 
     * @param array<string> $filtros
     * @return array
     */
    public function pesquisar(
        array $filtros,
    ): array {
        $ordenacao = (object) [
            'per_page' => data_get($filtros, 'per_page', 10),
            'page' => data_get($filtros, 'page', 1),
            'ordenar_por' => data_get($filtros, 'ordem', 'id'),
            'sentido' => data_get($filtros, 'direcao', 'asc')
        ];
        $resource = app($this->pesquisaPipeline)->execute($filtros);
        return $this->buscarRepository->index(resource: $resource, ordenacoes: $ordenacao);
    }

    /**
     * Serviço retorna o registro cadastrado.
     * 
     * @param array $dados
     * @param Model $modelo
     * @param array<string> $pipelines
     * 
     * @return array
     */
    public function adicionar(
        array $dados,
        Model $modelo,
        array $pipelines = [],
    ): array {
        return (new Pipeline(app()))
            ->send($dados)
            ->through($pipelines)
            ->then(function (array $dados) use ($modelo) {
                return $this->cadastrarRepository->cadastrar(dados: $dados, modelo: $modelo);
            });
    }

    /**
     * O serviço retorna um único registro à ser exibido
     * 
     * @param Model $modelo
     * @return array
     * 
     * @throws Exception
     */
    public function exibir(
        ?Model $modelo
    ): array {
        return $this->exibirRepository->exibir($modelo);
    }

    /**
     * O serviço retorna o registro atualizado
     * 
     * @param Model $modelo
     * @param array $dados
     * @return array
     * 
     * @throws Exception
     */
    public function atualizar(
        Model $modelo,
        array $dados
    ): array {
        return $this->atualizarRepository->atualizar(modelo: $modelo, dados: $dados);
    }

    /**
     * Serviço de exclusão do registro
     * 
     * @param Model $modelo
     * @return array
     * @throws Exception
     */
    public function remover(Model $modelo): array
    {
        return $this->removerRepository->remover(modelo: $modelo);
    }
}
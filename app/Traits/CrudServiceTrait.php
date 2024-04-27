<?php

namespace App\Traits;

use App\Models\Pet\Pet;
use App\Modules\Filtros\FiltrarId;
use Exception;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Pipeline\Pipeline;

trait CrudServiceTrait
{
    /**
     * Serviço retorna uma lista filtrada.
     * 
     * @param Request $request
     * @return array
     */
    public function pesquisar(
        Request $request,
        Model $model
    ): array {
        $ordenacao = (object) [
            'per_page' => $request->input('per_page') ?? 10,
            'page' => $request->input('page') ?? 1,
            'ordenar_por' => $request->input('ordem') ?? 'id',
            'sentido' => $request->input('direcao') ?? 'asc'
        ];
        $resource = app($this->pesquisaPipeline)->execute($model::query());
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
     * @param Model $model
     * @return array
     * 
     * @throws Exception
     */
    public function exibir(
        Model $model
    ): array {
        $modelo = (new Pipeline(app()))
            ->send($model::query())
            ->through([
                FiltrarId::class,
            ])
            ->thenReturn()
            ->first();
        return $this->exibirRepository->exibir($modelo);
    }
}

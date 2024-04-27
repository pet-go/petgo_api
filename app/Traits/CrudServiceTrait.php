<?php

namespace App\Traits;

use App\Modules\Filtros\FiltrarId;
use Exception;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
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
     * O serviço retorna um único registro à ser exibido
     * 
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
        $modelo = (new Pipeline(app()))
            ->send($modelo::query())
            ->through([
                FiltrarId::class,
            ])
            ->thenReturn()
            ->first();
        return $this->atualizarRepository->atualizar(modelo: $modelo, dados: $dados);
    }

    /**
     * Serviço de exclusão do registro
     * 
     * @param Model $modelo
     * @return array
     * 
     * @throws Exception
     */
    public function remover(Model $modelo): array
    {
        $modelo = (new Pipeline(app()))
            ->send($modelo::query())
            ->through([
                FiltrarId::class,
            ])
            ->thenReturn()
            ->first();
        return $this->removerRepository->remover(modelo: $modelo);
    }
}

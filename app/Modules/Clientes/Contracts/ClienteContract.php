<?php

namespace App\Modules\Clientes\Contracts;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Resources\Json\JsonResource;

interface ClienteContract
{
    public function index(Builder $resource, object $ordenacoes);
   /*  public function store(array $dados):JsonResource;
    public function show(Model|int $id):JsonResource;
    public function update(Model|int $id, array $dados):JsonResource;
    public function delete(Model|int $id):JsonResource; */
}

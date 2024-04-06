<?php

namespace App\Models\Cliente;

use App\Modules\Clientes\Enums\TipoDeContatoEnum;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Contato extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'contatos';
    protected $fillable = [
        'cliente_id',
        'tipo_de_contato',
        'email',
        'telefone',
        'main'
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'cliente_id' => 'integer',
            'tipo_de_contato' => TipoDeContatoEnum::class,
            'email' => 'string',
            'telefone' => 'string',
            'main' => 'boolean'
        ];
    }
}

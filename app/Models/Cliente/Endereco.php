<?php

namespace App\Models\Cliente;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Endereco extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'enderecos';

    protected $fillable = [
        'cliente_id',
        'logradouro',
        'bairro',
        'cidade',
        'mora_fora_do_pais',
        'pais'
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
            'logradouro' => 'string',
            'bairro' => 'string',
            'cidade' => 'string',
            'mora_fora_do_pais' => 'boolean',
            'pais' => 'string'
        ];
    }
}

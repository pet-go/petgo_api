<?php

namespace App\Models\Cliente;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Cliente extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'clientes';

    protected $fillable = [
        'nome',
        'nm_reduzido',
        'data_de_nascimento',
        'genero',
        'dados_adicionais'
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'nome' => 'string',
            'nm_reduzido' => 'string',
            'dados_adicionais' => 'json'
        ];
    }
}

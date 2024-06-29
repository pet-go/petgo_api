<?php

namespace App\Models\Cliente;

use App\Models\User\User;
use App\Modules\Clientes\Enums\TipoDeGeneroEnum;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;

class Cliente extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'clientes';

    protected $fillable = [
        'nome',
        'email',
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
            'dados_adicionais' => 'json',
            'genero' => TipoDeGeneroEnum::class,
        ];
    }

    /**
     * @return HasOne
     */
    public function usuario(): HasOne
    {
        return $this->HasOne(User::class, 'cliente_id');
    }
}

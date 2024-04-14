<?php

namespace App\Models\Pet;

use App\Models\Cliente\Cliente;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class Pet extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'pets';

    protected $fillable = [
        'nome',
        'cliente_id',
        'estirpe_id',
        'data_de_nascimento'
    ];

    /**
     * @return BelongsTo
     */
    public function cliente(): BelongsTo
    {
        return $this->belongsTo(Cliente::class);
    }

    /**
     * @return BelongsTo;
     */
    public function estirpe(): BelongsTo
    {
        return $this->belongsTo(Estirpe::class);
    }
}

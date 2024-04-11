<?php

namespace App\Models\Pet;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Especie extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'especies';
    protected $fillable = ['nome'];

    /**
     * @return HasMany
     */
    public function estirpes(): HasMany
    {
        return $this->hasMany(Estirpe::class);
    }
}

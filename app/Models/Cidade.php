<?php

namespace App\Models;

use Database\Factories\CidadeFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Collection;

/**
 * @property-read int $id
 * @property-read string nome
 * @property-read string estado
 * @property-read Collection<Medico[]> $medicos
 *
 * @method static CidadeFactory factory($count = null, $state = [])
 */
class Cidade extends Model
{
    protected $table = 'cidade';

    use HasFactory, SoftDeletes;

    protected $fillable = [
        'nome',
        'estado',
    ];

    public function medicos(): HasMany
    {
        return $this->hasMany(Medico::class, 'cidade_id');
    }
}

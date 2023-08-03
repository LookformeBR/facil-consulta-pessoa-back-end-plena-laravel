<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * @property-read int $id
 * @property-read string nome
 * @property-read string estado
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

<?php

namespace App\Models;

use Database\Factories\MedicoFactory;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * @property-read int $id
 * @property-read string nome
 * @property-read string especialidade
 * @property-read int cidade_id
 * @property-read Cidade $cidade
 * @property-read MedicoPaciente $medicoPaciente
 *
 * @method static MedicoFactory factory($count = null, $state = [])
 */
class Medico extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'medico';

    protected $fillable = [
        'nome',
        'especialidade',
        'cidade_id',
    ];

    public function cidade(): BelongsTo
    {
        return $this->belongsTo(Cidade::class);
    }

    public function medicoPaciente(): HasMany
    {
        return $this->hasMany(MedicoPaciente::class);
    }

    /**
     * @return Illuminate\Database\Eloquent\Builder
     **/
    public function scopeFilteredByCity(Builder $query, int $id): Builder
    {
        return $query->where('cidade_id', $id);
    }

    /**
     * @return Illuminate\Database\Eloquent\Builder
     **/
    public function scopeFilteredByPatient(Builder $query, int $id): Builder
    {
        return $query->where('paciente_id', $id);
    }
}

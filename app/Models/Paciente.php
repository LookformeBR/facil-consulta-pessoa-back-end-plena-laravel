<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * @property-read int $id
 * @property-read string nome
 * @property-read string cpf
 * @property-read string celular
 */
class Paciente extends Model
{
    use HasFactory;

    protected $table = 'paciente';

    protected $fillable = [
        'nome',
        'cpf',
        'celular',
    ];

    public function medicoPaciente(): HasMany
    {
        return $this->hasMany(MedicoPaciente::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     **/
    public function scopeFilteredByDoctorId(Builder $query, int $id): Builder
    {
        return $query->whereHas('medicoPaciente', function (Builder $query) use ($id): void {
            $query->where('medico_id', $id);
        });
    }
}

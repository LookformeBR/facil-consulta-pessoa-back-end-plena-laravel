<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

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
        return $this->belongsTo(Cidades::class);
    }

    /**
     * @return Illuminate\Database\Eloquent\Builder
     **/
    public function scopeCity(Builder $query, int $id): Builder
    {
        return $query->where('cidade_id', $id);
    }

    /**
     * @return Illuminate\Database\Eloquent\Builder
     **/
    public function scopePatients(Builder $query, int $id): Builder
    {
        return $query->where('paciente_id', $id);
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class MedicoPaciente extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'medico';

    public function medico(): BelongsTo
    {
        return $this->belongsTo(Medico::class);
    }

    public function paciente(): BelongsTo
    {
        return $this->belongsTo(Paciente::class);
    }
}

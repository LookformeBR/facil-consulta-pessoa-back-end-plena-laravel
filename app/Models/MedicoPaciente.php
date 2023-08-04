<?php

namespace App\Models;

use Database\Factories\MedicoPacienteFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * @property-read int $id
 * @property-read int medico_id
 * @property-read int paciente_id
 * @property-read Medico $medico
 * @property-read Paciente $paciente
 *
 * @method static MedicoPacienteFactory factory($count = null, $state = [])
 */
class MedicoPaciente extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'medico_paciente';

    protected $fillable = [
        'medico_id',
        'paciente_id',
    ];

    public function medico(): BelongsTo
    {
        return $this->belongsTo(Medico::class);
    }

    public function paciente(): BelongsTo
    {
        return $this->belongsTo(Paciente::class);
    }
}

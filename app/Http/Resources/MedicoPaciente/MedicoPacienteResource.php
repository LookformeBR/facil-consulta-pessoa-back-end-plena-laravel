<?php

namespace App\Http\Resources\MedicoPaciente;

use App\Http\Resources\Medico\MedicoResource;
use App\Http\Resources\Paciente\PacienteResource;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class MedicoPacienteResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'medico' => new MedicoResource($this->medico),
            'paciente' => new PacienteResource($this->paciente),
        ];
    }
}

<?php

namespace App\Http\Resources\Medico;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CompactMedicoResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'nome' => $this->nome,
            'especialidade' => $this->especialidade,
            'cidade_id' => $this->cidade_id,
        ];
    }
}

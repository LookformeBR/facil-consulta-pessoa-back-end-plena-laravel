<?php

namespace App\Http\Resources\Cidade;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CompactCidadeResource extends JsonResource
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
            'estado' => $this->estado,
        ];
    }
}

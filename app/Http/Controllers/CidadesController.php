<?php

namespace App\Http\Controllers;

use App\Http\Resources\CompactCidadeResource;
use App\Http\Resources\CompactMedicoResource;
use App\Models\Cidade;
use App\Models\Medico;
use Illuminate\Http\JsonResponse;

class CidadesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): JsonResponse
    {
        return response()->json(CompactCidadeResource::collection(Cidade::all()));
    }

    public function doctors(int $id): JsonResponse
    {
        $cidade_id = Cidade::findOrFail($id)->id;

        return response()->json(CompactMedicoResource::collection(Medico::query()->filteredByCity($cidade_id)->get()));
    }
}

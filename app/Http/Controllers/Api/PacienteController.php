<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Paciente\PacienteEditRequest;
use App\Http\Requests\Paciente\PacienteStoreRequest;
use App\Http\Resources\Paciente\PacienteResource;
use App\Models\Paciente;
use Illuminate\Http\JsonResponse;

class PacienteController extends Controller
{
    /**
     * Store a newly created resource in storage.
     */
    public function store(PacienteStoreRequest $request): JsonResponse
    {
        return response()->json(new PacienteResource(Paciente::create($request->validated())), 201);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function edit(PacienteEditRequest $request, int $id): JsonResponse
    {
        $paciente = Paciente::findOrFail($id);
        $paciente->update($request->validated());

        return response()
            ->json(new PacienteResource($paciente->refresh()));
    }
}

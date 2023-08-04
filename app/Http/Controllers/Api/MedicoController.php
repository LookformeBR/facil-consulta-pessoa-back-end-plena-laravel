<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Medico\LinkPatientRequest;
use App\Http\Requests\Medico\StoreMedicoRequest;
use App\Http\Resources\Medico\CompactMedicoResource;
use App\Http\Resources\Medico\MedicoResource;
use App\Http\Resources\MedicoPaciente\MedicoPacienteResource;
use App\Http\Resources\Paciente\PacienteResource;
use App\Models\Medico;
use App\Models\Paciente;
use Illuminate\Http\JsonResponse;

class MedicoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): JsonResponse
    {
        return response()->json(CompactMedicoResource::collection(Medico::all()));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreMedicoRequest $request): JsonResponse
    {
        return response()->json(new MedicoResource(Medico::create($request->validated())), 201);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function linkPatient(LinkPatientRequest $request, int $id): JsonResponse
    {
        $medico = Medico::findorFail($id);

        return response()
            ->json(new MedicoPacienteResource($medico->medicoPaciente()->create($request->validated())), 201);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function patients(int $id): JsonResponse
    {
        $medico = Medico::query()->findOrFail($id);

        return response()
            ->json(PacienteResource::collection(Paciente::query()->filteredByDoctorId($medico->id)->get()));
    }
}

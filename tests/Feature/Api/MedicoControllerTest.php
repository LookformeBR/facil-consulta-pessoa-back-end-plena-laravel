<?php

namespace Tests\Feature\Api;

use App\Models\Cidade;
use App\Models\Medico;
use App\Models\MedicoPaciente;
use App\Models\Paciente;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use Tymon\JWTAuth\Facades\JWTAuth;

class MedicoControllerTest extends TestCase
{
    use RefreshDatabase;

    public function test_it_should_list_all_doctors(): void
    {
        $medicos = Medico::factory(10)->create();
        $this->getJson(route('medico.index'))
            ->assertStatus(200)
            ->assertJson($medicos->map(function (Medico $medico): array {
                return [
                    'id' => $medico->id,
                    'nome' => $medico->nome,
                    'especialidade' => $medico->especialidade,
                    'cidade_id' => $medico->cidade_id,
                ];
            })->toArray());
    }

    public function test_it_should_store_new_doctor(): void
    {
        $user = User::factory()->createOne();
        $token = JWTAuth::fromUser($user);

        $headers = [
            'Accept' => 'application/json',
            'Authorization' => 'Bearer '.$token,
        ];

        $doctor = [
            'nome' => 'Nome',
            'especialidade' => 'especialidade',
            'cidade_id' => Cidade::factory()->createOne()->id,
        ];

        $this->postJson(route('medico.store'), $doctor, $headers)
            ->assertStatus(201)
            ->assertJsonFragment($doctor);
    }

    public function test_it_should_store_not_authorized(): void
    {
        $doctor = [
            'nome' => 'Nome',
            'especialidade' => 'especialidade',
            'cidade_id' => Cidade::factory()->createOne()->id,
        ];

        $this->postJson(route('medico.store'), $doctor)
            ->assertStatus(401);
    }

    public function test_it_should_validate_data(): void
    {
        $user = User::factory()->createOne();
        $token = JWTAuth::fromUser($user);

        $headers = [
            'Accept' => 'application/json',
            'Authorization' => 'Bearer '.$token,
        ];

        $doctor = [
            'nome' => null,
            'especialidade' => null,
            'cidade_id' => null,
        ];

        $this->postJson(route('medico.store'), $doctor, $headers)
            ->assertStatus(422);
    }

    public function test_it_should_link_patient(): void
    {
        $user = User::factory()->createOne();
        $token = JWTAuth::fromUser($user);

        $headers = [
            'Accept' => 'application/json',
            'Authorization' => 'Bearer '.$token,
        ];

        $medico = Medico::factory()->createOne();
        $paciente = Paciente::Factory()->createOne();

        $this->postJson(route('medico.linkPatient', ['id' => $medico->id]),
            [
                'medico_id' => $medico->id,
                'paciente_id' => $paciente->id,
            ],
            $headers
        )
            ->assertStatus(201)
            ->assertJsonFragment($medico->only(['id', 'nome']));
    }

    public function test_it_should_link_patient_not_authorized(): void
    {
        $doctor = [
            'nome' => 'Nome',
            'especialidade' => 'especialidade',
            'cidade_id' => Cidade::factory()->createOne()->id,
        ];

        $medico = Medico::factory()->createOne();

        $this->postJson(route('medico.linkPatient', ['id' => $medico->id]), $doctor)
            ->assertStatus(401);
    }

    public function test_it_should_list_patients(): void
    {
        $user = User::factory()->createOne();
        $token = JWTAuth::fromUser($user);

        $headers = [
            'Accept' => 'application/json',
            'Authorization' => 'Bearer '.$token,
        ];

        $medico = Medico::factory()->createOne();
        $paciente = Paciente::factory()->createOne();
        MedicoPaciente::factory()->for($medico)->for($paciente)->createOne();

        $this->getJson(route('medico.patients', ['id' => $medico->id]), $headers)
            ->assertStatus(200)
            ->assertJsonFragment([
                'id' => $paciente->id,
                'nome' => $paciente->nome,
                'cpf' => $paciente->cpf,
            ]);
    }

    public function test_it_should_list_patients_not_authorized(): void
    {
        $doctor = [
            'nome' => 'Nome',
            'especialidade' => 'especialidade',
            'cidade_id' => Cidade::factory()->createOne()->id,
        ];

        $medico = Medico::factory()->createOne();

        $this->getJson(route('medico.patients', ['id' => $medico->id]), $doctor)
            ->assertStatus(401);
    }
}

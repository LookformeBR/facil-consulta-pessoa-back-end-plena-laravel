<?php

namespace Tests\Feature\Api;

use App\Models\Paciente;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use Tymon\JWTAuth\Facades\JWTAuth;

class PacienteControllerTest extends TestCase
{
    use RefreshDatabase;

    public function test_it_should_store_new_paciente(): void
    {
        $user = User::factory()->createOne();
        $token = JWTAuth::fromUser($user);

        $headers = [
            'Accept' => 'application/json',
            'Authorization' => 'Bearer '.$token,
        ];

        $data = [
            'nome' => 'Nome',
            'cpf' => '662.669.840-08',
            'celular' => '(11) 9 8484-6363',
        ];

        $this->postJson(route('paciente.store'), $data, headers: $headers)
            ->assertStatus(201)
            ->assertJsonFragment([
                'nome' => $data['nome'],
                'cpf' => $data['cpf'],
            ]);
    }

    public function test_it_should_store_not_authorized(): void
    {
        $data = [
            'nome' => 'Nome',
            'cpf' => '662.669.840-08',
            'celular' => '(11) 9 8484-6363',
        ];

        $this->postJson(route('paciente.store'), $data)
            ->assertStatus(401);
    }

    public function test_it_should_store_has_errors(): void
    {
        $user = User::factory()->createOne();
        $token = JWTAuth::fromUser($user);

        $headers = [
            'Accept' => 'application/json',
            'Authorization' => 'Bearer '.$token,
        ];

        $data = [
            'nome' => 'Nome',
            'cpf' => '662.669.840-08',
            'celular' => ['(11) 9 8484-6363'],
        ];

        $this->postJson(route('paciente.store'), $data, headers: $headers)
            ->assertStatus(422);
    }

    public function test_it_should_edit_paciente(): void
    {
        $user = User::factory()->createOne();
        $token = JWTAuth::fromUser($user);

        $headers = [
            'Accept' => 'application/json',
            'Authorization' => 'Bearer '.$token,
        ];
        $paciente = Paciente::factory()->createOne();

        $data = [
            'nome' => 'Nome',
            'cpf' => '662.669.840-08',
            'celular' => '(11) 9 8484-6363',
        ];

        $this->putJson(route('paciente.edit', ['id' => $paciente->id]), $data, headers: $headers)
            ->assertStatus(200)
            ->assertJsonFragment([
                'nome' => $data['nome'],
                'cpf' => $data['cpf'],
            ]);
    }

    public function test_it_should_edit_has_errors(): void
    {
        $user = User::factory()->createOne();
        $token = JWTAuth::fromUser($user);

        $headers = [
            'Accept' => 'application/json',
            'Authorization' => 'Bearer '.$token,
        ];
        $paciente = Paciente::factory()->createOne();

        $data = [
            'nome' => 'Nome',
            'cpf' => '662.669.840-08',
            'celular' => ['(11) 9 8484-6363'],
        ];

        $this->putJson(route('paciente.edit', ['id' => $paciente->id]), $data, headers: $headers)
            ->assertStatus(422);
    }

    public function test_it_should_edit_not_authorized(): void
    {
        $paciente = Paciente::factory()->createOne();

        $data = [
            'nome' => 'Nome',
            'cpf' => '662.669.840-08',
            'celular' => '(11) 9 8484-6363',
        ];

        $this->putJson(route('paciente.edit', ['id' => $paciente->id]), $data)
            ->assertStatus(401);
    }
}

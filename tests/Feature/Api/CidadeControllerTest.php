<?php

namespace Tests\Feature\Api;

use App\Models\Cidade;
use App\Models\Medico;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CidadeControllerTest extends TestCase
{
    use RefreshDatabase;

    public function test_it_should_list_all_cities(): void
    {
        $cidades = Cidade::factory(10)->create();
        $this->getJson(route('cidade.index'))
            ->assertStatus(200)
            ->assertJson($cidades->map(function (Cidade $cidade): array {
                return [
                    'id' => $cidade->id,
                    'nome' => $cidade->nome,
                    'estado' => $cidade->estado,
                ];
            })->toArray());
    }

    public function test_it_should_list_doctors_by_city(): void
    {
        $cidade = Cidade::factory()->createOne();

        $medicos = Medico::factory(10)->for($cidade)->create();

        $this->getJson(route('cidade.doctors', ['id' => $cidade->id]))
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
}

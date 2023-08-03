<?php

namespace Database\Seeders;

use App\Models\Cidade;
use App\Models\Medico;
use App\Models\MedicoPaciente;
use App\Models\Paciente;
use Illuminate\Database\Seeder;

class ExampleDataSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $this->createCities();
        $this->createDoctors();
        $this->createPatients();
        $this->createDoctorsAndPatients();
    }

    public function createCities(): void
    {
        Cidade::factory(20)->create();
    }

    public function createDoctors(): void
    {
        Cidade::all()->each(function (Cidade $cidade): void {
            Medico::factory(10)->for($cidade)->create();
        });
    }

    public function createPatients(): void
    {
        Paciente::factory(100)->create();
    }

    public function createDoctorsAndPatients(): void
    {
        Paciente::all()->each(function (Paciente $paciente): void {
            $medico = Medico::query()->orderByRaw('RAND()')->first();
            MedicoPaciente::factory()
                ->for($medico)
                ->for($paciente)
                ->create();
        });
    }
}

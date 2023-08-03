<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::query()->create([
            'name' => 'Christian Ramires',
            'email' => 'christian.ramires@example.com',
            'password' => Hash::make('password'),
            'email_verified_at' => now(),
        ]);

        User::query()->create([
            'name' => 'Krishna Ferreira Xavier',
            'email' => 'krishna.ferreira.xavier@facilconsulta.com.br',
            'password' => Hash::make('password'),
            'email_verified_at' => now(),
        ]);

        User::factory(100)->create();
    }
}

<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\State;

class StateSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $states = [
            ['name' => 'Reparación'],
            ['name' => 'Taller'],
            ['name' => 'Salida para técnico'],
            ['name' => 'Roto'],
            ['name' => 'Eliminado'],
        ];

        foreach ($states as $state) {
            State::create($state);
        }
    }
}

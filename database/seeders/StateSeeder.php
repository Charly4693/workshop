<?php

namespace Database\Seeders;

use App\Models\State;
use Illuminate\Database\Seeder;

class StateSeeder extends Seeder
{
    public function run(): void
    {
        foreach (['Reparación', 'Taller', 'Salida para técnico', 'Roto', 'Eliminado'] as $name) {
            State::firstOrCreate(['name' => $name]);
        }
    }
}

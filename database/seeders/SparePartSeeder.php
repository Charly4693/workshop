<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\SparePart;
use App\Models\State;

class SparePartSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Usamos el estado "Reparación" por defecto
        $state = State::where('name', 'Reparación')->first();

        // Asegúrate de que los IDs correspondan a los de tu FactorySeeder
        $spareParts = [
            ['name' => 'Placa Gistra', 'factory_id' => 12],
            ['name' => 'Placa Tecnausa', 'factory_id' => 11],
            ['name' => 'Multimoneda', 'factory_id' => 9],
            ['name' => 'Billetero', 'factory_id' => 9],
            ['name' => 'Monedero', 'factory_id' => 10],
            ['name' => 'Reciclador', 'factory_id' => 9],
            ['name' => 'Desviador', 'factory_id' => 16],
            ['name' => 'Stacker', 'factory_id' => 9],
            ['name' => 'Hopper', 'factory_id' => 6],
            ['name' => 'Pantalla', 'factory_id' => 13],
            ['name' => 'CPU', 'factory_id' => 4],
            ['name' => 'SAI', 'factory_id' => 5],
            ['name' => 'Bateria', 'factory_id' => 1],
            ['name' => 'Pila', 'factory_id' => 1],
            ['name' => 'Máquina conteo billetes', 'factory_id' => 9],
            ['name' => 'Táctil', 'factory_id' => 13],
            ['name' => 'Tft', 'factory_id' => 13],
        ];

        foreach ($spareParts as $part) {
            SparePart::create([
                'name' => $part['name'],
                'factory_id' => $part['factory_id'],
                'state_id' => $state->id,
            ]);
        }
    }
}

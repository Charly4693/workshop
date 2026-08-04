<?php

namespace Database\Seeders;

use App\Models\Factory;
use App\Models\SparePart;
use App\Models\State;
use Illuminate\Database\Seeder;

class SparePartSeeder extends Seeder
{
    public function run(): void
    {
        $state = State::where('name', 'Reparación')->firstOrFail();
        $firstFactory = Factory::where('cif', 'B10000001')->firstOrFail();
        $secondFactory = Factory::where('cif', 'B10000002')->firstOrFail();

        $spareParts = [
            ['name' => 'Placa de demostración', 'factory_id' => $firstFactory->id],
            ['name' => 'Pantalla de demostración', 'factory_id' => $secondFactory->id],
        ];

        foreach ($spareParts as $sparePart) {
            SparePart::updateOrCreate(
                [
                    'name' => $sparePart['name'],
                    'factory_id' => $sparePart['factory_id'],
                ],
                ['state_id' => $state->id],
            );
        }
    }
}

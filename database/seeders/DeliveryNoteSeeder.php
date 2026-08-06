<?php

namespace Database\Seeders;

use App\Models\DeliveryNote;
use App\Models\Local;
use App\Models\Machine;
use App\Models\SparePart;
use App\Models\State;
use Illuminate\Database\Seeder;

class DeliveryNoteSeeder extends Seeder
{
    public function run(): void
    {
        $local = Local::where('idMachines', '1640')->firstOrFail();
        $machine = Machine::where('identificador', 'DEMO-MACHINE-CHILD-001')->firstOrFail();
        $sparePart = SparePart::where('name', 'Placa de demostración')->firstOrFail();
        $state = State::where('name', 'Reparación')->firstOrFail();

        DeliveryNote::updateOrCreate(
            ['comment' => 'Albarán ficticio para desarrollo automatizado.'],
            [
                'spare_part_id' => $sparePart->id,
                'state_id' => $state->id,
                'local_id' => $local->id,
                'bar_id' => null,
                'machine_id' => $machine->id,
                'user_id' => null,
            ],
        );
    }
}

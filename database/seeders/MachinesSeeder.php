<?php

namespace Database\Seeders;

use App\Models\Bar;
use App\Models\Local;
use App\Models\Machine;
use Illuminate\Database\Seeder;

class MachinesSeeder extends Seeder
{
    public function run(): void
    {
        $local = Local::where('idMachines', '1640')->firstOrFail();
        $bar = Bar::where('dni_cif', 'B00000001')->firstOrFail();

        $parent = Machine::updateOrCreate(
            ['identificador' => 'DEMO-MACHINE-PARENT-001'],
            [
                'name' => 'Máquina padre de demostración',
                'alias' => 'PADRE DEMO',
                'type' => 'parent',
                'local_id' => $local->id,
                'bar_id' => null,
                'parent_id' => null,
            ],
        );

        Machine::updateOrCreate(
            ['identificador' => 'DEMO-MACHINE-CHILD-001'],
            [
                'name' => 'Máquina hija de demostración',
                'alias' => 'HIJA DEMO',
                'type' => 'roulette',
                'local_id' => $local->id,
                'bar_id' => null,
                'parent_id' => $parent->id,
            ],
        );

        Machine::updateOrCreate(
            ['identificador' => 'DEMO-MACHINE-BAR-001'],
            [
                'name' => 'Máquina de bar de demostración',
                'alias' => 'BAR DEMO',
                'type' => 'single',
                'local_id' => null,
                'bar_id' => $bar->id,
                'parent_id' => null,
            ],
        );
    }
}

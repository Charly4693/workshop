<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\DeliveryNote;
use App\Models\SparePart;
use App\Models\State;
use App\Models\Local;
use App\Models\Machine;
use App\Models\User;
use App\Models\Bar;

class DeliveryNoteSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Si las tablas tienen registros previos, se tomarán aleatoriamente
        $spareParts = SparePart::pluck('id')->toArray();
        $states = State::pluck('id')->toArray();
        $locals = Local::pluck('id')->toArray();
        $machines = Machine::pluck('id')->toArray();
        $users = User::pluck('id')->toArray();
        $bars = class_exists(Bar::class) ? Bar::pluck('id')->toArray() : [];

        // Crea 10 notas de entrega aleatorias
        for ($i = 0; $i < 10; $i++) {
            DeliveryNote::create([
                'spare_part_id' => $spareParts ? fake()->randomElement($spareParts) : null,
                'state_id' => $states ? fake()->randomElement($states) : null,
                'local_id' => $locals ? fake()->randomElement($locals) : null,
                'bar_id' => $bars ? fake()->randomElement($bars) : null,
                'machine_id' => $machines ? fake()->randomElement($machines) : null,
                'user_id' => $users ? fake()->randomElement($users) : null,
            ]);
        }
    }
}

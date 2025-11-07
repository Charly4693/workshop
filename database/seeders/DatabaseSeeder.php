<?php

namespace Database\Seeders;

use App\Models\Factory;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        /* User::factory(10)->create();

        User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]);*/

        $this->call([
            UsersSeeder::class,
            LocalSeeder::class,
            BarSeeder::class,
            MachinesSeeder::class,
            FactorySeeder::class,
            StateSeeder::class,
            SparePartSeeder::class,
            DeliveryNoteSeeder::class
        ]);
    }
}

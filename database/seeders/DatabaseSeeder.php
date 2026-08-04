<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            FactorySeeder::class,
            StateSeeder::class,
            LocalSeeder::class,
            BarSeeder::class,
            UsersSeeder::class,
            MachinesSeeder::class,
            SparePartSeeder::class,
            DeliveryNoteSeeder::class,
        ]);
    }
}

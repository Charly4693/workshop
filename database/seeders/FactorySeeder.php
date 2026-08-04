<?php

namespace Database\Seeders;

use App\Models\Factory;
use Illuminate\Database\Seeder;

class FactorySeeder extends Seeder
{
    public function run(): void
    {
        $factories = [
            [
                'name' => 'Fabricante Ficticio Uno, S.L.',
                'address' => 'Calle Industrial, 1',
                'city' => 'Ciudad de Prueba',
                'phone' => '000000001',
                'email' => 'fabricante1@example.test',
                'cif' => 'B10000001',
            ],
            [
                'name' => 'Fabricante Ficticio Dos, S.L.',
                'address' => 'Calle Industrial, 2',
                'city' => 'Ciudad de Prueba',
                'phone' => '000000002',
                'email' => 'fabricante2@example.test',
                'cif' => 'B10000002',
            ],
        ];

        foreach ($factories as $factory) {
            Factory::updateOrCreate(['cif' => $factory['cif']], $factory);
        }
    }
}

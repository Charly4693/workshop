<?php

namespace Database\Seeders;

use App\Models\Bar;
use Illuminate\Database\Seeder;

class BarSeeder extends Seeder
{
    public function run(): void
    {
        $bars = [
            [
                'name' => 'Bar de demostración Centro',
                'holder' => 'Empresa Ficticia Centro, S.L.',
                'dni_cif' => 'B00000001',
                'address' => 'Calle Ejemplo, 1',
                'town' => 'Ciudad de Prueba',
            ],
            [
                'name' => 'Bar de demostración Puerto',
                'holder' => 'Empresa Ficticia Puerto, S.L.',
                'dni_cif' => 'B00000002',
                'address' => 'Avenida de Prueba, 2',
                'town' => 'Ciudad de Prueba',
            ],
        ];

        foreach ($bars as $bar) {
            Bar::updateOrCreate(['dni_cif' => $bar['dni_cif']], $bar);
        }
    }
}

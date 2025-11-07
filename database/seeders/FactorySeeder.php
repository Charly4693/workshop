<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Factory;

class FactorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $factories = [
            [
                'name' => 'AESBYM ELECTRONICOS, SL',
                'address' => 'C/ DR. BUEN, Nº 38, BENIMAMET (VALENCIA), CP 46035',
                'city' => 'Valencia',
                'phone' => null,
            ],
            [
                'name' => 'BATEMAT SA',
                'address' => 'C/ PUJADES Nº60 PLANTA 4-SEGUNDA, CP 08005 BARCELONA',
                'city' => 'Barcelona',
                'phone' => 'Horario 8:30 a 16:30',
            ],
            [
                'name' => 'RETABET',
                'address' => 'C/ NEMESIO MOGROBEJO 5, 48015 BILBAO',
                'city' => 'Bilbao',
                'phone' => '902 110 793 / WhatsApp 629 721 577',
            ],
            [
                'name' => 'RECREATIVOS FRANCO',
                'address' => 'CAMINO SAN MARTÍN DE LA VEGA, 21, 28500 ARGANDA DEL REY (MADRID)',
                'city' => 'Madrid',
                'phone' => null,
            ],
            [
                'name' => 'PROTECSUR',
                'address' => 'C/ SIERRA LAS VILLAS Nº36, CP 04240 VIATOR (ALMERÍA)',
                'city' => 'Almería',
                'phone' => null,
            ],
            [
                'name' => 'UNIDESA - EUROPEA UNIVERSAL DE DESARROLLOS ELECTRONICOS',
                'address' => 'C/ SENA 2-10 PUERTA 10, RECEPCION DE MATERIAL, CP 08174 SAN CUGAT DEL VALLES (BARCELONA)',
                'city' => 'Barcelona',
                'phone' => '937360100',
            ],
            [
                'name' => 'ORENES',
                'address' => 'AVENIDA ALEJANDRO VALVERDE, 170 (ANTIGUA CARRETERA DE ALICANTE), CP 30007 MURCIA',
                'city' => 'Murcia',
                'phone' => '968242500',
            ],
            [
                'name' => 'NOVOMATIC',
                'address' => 'Polígono Industrial "La Garena", C/ Galileo Galilei, 28, 28806 Alcalá de Henares (Madrid)',
                'city' => 'Madrid',
                'phone' => null,
            ],
            [
                'name' => 'INNOVATIVE TECHNOLOGY',
                'address' => 'Carrer de Caracas, 13, CP 08030 Barcelona',
                'city' => 'Barcelona',
                'phone' => '933600330',
            ],
            [
                'name' => 'INFINITY GAMING SL',
                'address' => 'C/ CARDENAL BELLUGA NAVE 24/25, CP 30169 SAN GINES (MURCIA)',
                'city' => 'Murcia',
                'phone' => '968393986',
            ],
            [
                'name' => 'TECNAUSA',
                'address' => 'C/ VALVERDE DEL CAMINO, 24, POLIGONO INDUSTRIAL DE CARRUS, CP 03291 ELCHE (ALICANTE)',
                'city' => 'Elche',
                'phone' => null,
            ],
            [
                'name' => 'GISTRA',
                'address' => 'COMARQUES DEL PAIS VALENCIA 63, POLIGONO INDUSTRIAL QUART DE POBLET, CP 46930 Quart de Poblet',
                'city' => 'Quart de Poblet',
                'phone' => '962069092',
            ],
            [
                'name' => 'GIGAMES',
                'address' => 'AV/ CAN JOFRESA, 69, POL. IND. SANTA MARGARITA II, 08223 TERRASSA (BARCELONA)',
                'city' => 'Terrassa',
                'phone' => '937845670',
            ],
            [
                'name' => 'DOSNIHA GAMING SLU',
                'address' => 'CALLE DE LA MAQUINARIA 6, POL. IND. SON VALENTI, CP 07011 PALMA DE MALLORCA',
                'city' => 'Palma de Mallorca',
                'phone' => null,
            ],
            [
                'name' => 'COSTA CALIDA SL',
                'address' => 'C/ LEVANTE, CRTRA BENIAJAN KM 4, CP 30570 BENIAJAN (MURCIA)',
                'city' => 'Murcia',
                'phone' => '630086499',
            ],
            [
                'name' => 'COMATEL SL',
                'address' => 'CALLE 21, NAVE 39 Y 43, POLIGONO INDUSTRIAL DE CATARROJA, CP 46470 CATARROJA (VALENCIA)',
                'city' => 'Catarroja',
                'phone' => null,
            ],
        ];

        foreach ($factories as $factory) {
            Factory::create($factory);
        }
    }
}

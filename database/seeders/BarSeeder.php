<?php

namespace Database\Seeders;

use App\Models\Bar;
use Illuminate\Database\Seeder;

class BarSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            // Zona 1: Benidorm
            [
                'name' => 'Amanecer',
                'holder' => 'Amanecer 2017, S.L',
                'dni_cif' => 'B09948175',
                'address' => 'C/ Xalo Edf, Las Mimosas Bloque 1 Locales A0-B0-F0-G0',
                'town' => 'Finestrat',
            ],
            [
                'name' => '8 de Copes',
                'holder' => 'Jorge Ferrer Lloret',
                'dni_cif' => '48297885R',
                'address' => 'C/ San Pere, 8 bajo',
                'town' => 'Altea',
            ],
            [
                'name' => 'Pedrera',
                'holder' => 'Rte. La Pedrera S.C',
                'dni_cif' => 'G03327467',
                'address' => 'Pol. Industrial Pedrera',
                'town' => 'Benissa',
            ],
            [
                'name' => 'La Maya',
                'holder' => 'Alexandra Daniela Luca',
                'dni_cif' => 'Y0860608P',
                'address' => 'Av Marina Baixa, 42 Esc. 1 Local 6 Edif. Cardenal III',
                'town' => 'Finestrat',
            ],
            [
                'name' => 'Bar La Maya',
                'holder' => 'Alexandra Daniela Luca',
                'dni_cif' => 'Y0860608P',
                'address' => 'Pasaje Santa Rita de Casia, 2 escale 1, bajo D',
                'town' => 'Benidorm',
            ],
            [
                'name' => 'Pulpo Pirata',
                'holder' => 'Aperador Hnos. C.B',
                'dni_cif' => 'E53068433',
                'address' => 'Tomas Ortuño, 59',
                'town' => 'Benidorm',
            ],
            [
                'name' => 'Angel de Benidorm',
                'holder' => 'Jose Delgado Diaz',
                'dni_cif' => '48299344B',
                'address' => 'Esperanto, Local 10 Edif. Zeus',
                'town' => 'Benidorm',
            ],
            [
                'name' => 'Picadilly Mediterráneo',
                'holder' => 'Juan Berenguer Saval y Otros, C.B',
                'dni_cif' => 'E53994604',
                'address' => 'Av/ Mediterráneo, 23, Edif. Circo, L.5,6,7,8',
                'town' => 'Benidorm',
            ],
            [
                'name' => 'Las Tablas',
                'holder' => 'Frederick Alexandre Larre',
                'dni_cif' => 'Y8812560D',
                'address' => 'Av/ Cuenca, Edif. Monver VI L-2',
                'town' => 'Benidorm',
            ],
            [
                'name' => 'Picadilly',
                'holder' => 'Berenguer Aznar, S.C',
                'dni_cif' => 'J54706767',
                'address' => 'Av/ Ametlla de Mar C.C. Mercaloix Ent. C/ Gerona Nº11 L-5,6,7.',
                'town' => 'Benidorm',
            ],
            [
                'name' => 'Veneto',
                'holder' => 'Jofran, S.C',
                'dni_cif' => 'G03882891',
                'address' => 'Av/ Filipinas, Edif Trebol, Local 4-5',
                'town' => 'Benidorm',
            ],
            [
                'name' => 'Zarcar',
                'holder' => 'Zarcar SL',
                'dni_cif' => 'B03787710',
                'address' => 'Pais Valencia, 120 Bajo Local 1',
                'town' => 'Finestrat',
            ],
            [
                'name' => 'Albeniz',
                'holder' => 'Jose Miguel Garcia Gomez',
                'dni_cif' => '46694162E',
                'address' => 'Herreria Edif. Albeniz L-8A',
                'town' => 'Alfaz del Pi',
            ],
            [
                'name' => 'Puntxaetes',
                'holder' => 'Julian Jimenez Garcia',
                'dni_cif' => '48679635C',
                'address' => 'C/ Pianista Gonzalo Soriano Nº3 Local 2',
                'town' => 'Villajoyosa',
            ],
            [
                'name' => 'Yorkos',
                'holder' => 'Plamenov Services 2015, S.L',
                'dni_cif' => 'B54885207',
                'address' => 'Av/ Rosa Dels Vents, 7 Edif. Gemelos 24 Bq 1 Esq C/ Marinada L14',
                'town' => 'Villajoyosa',
            ],
            [
                'name' => 'El Sol',
                'holder' => 'Victoria Perez Selles',
                'dni_cif' => '20027337H',
                'address' => 'Evaristo Manero, 9 Bajo',
                'town' => 'Relleu',
            ],
            [
                'name' => 'La Grada Deportiva',
                'holder' => 'Bar Grada Deportiva, S.L',
                'dni_cif' => 'B44623023',
                'address' => 'Av/ Marina Baixa, 2 Local 3',
                'town' => 'La Nucia',
            ],
            [
                'name' => 'Bulevar Benidorm',
                'holder' => 'Luz Yanett Gordillo Ordoñez',
                'dni_cif' => 'Y7885635F',
                'address' => 'Av.Alfonso Puchadas Edif. Marina Finestrat Nº2 Bajo Local 2',
                'town' => 'Benidorm',
            ],
            [
                'name' => 'New Litte',
                'holder' => 'Victor Oswaldo Benitez Navarro',
                'dni_cif' => '29026313Z',
                'address' => 'Les Aigües, Local 3, Edif. Coblança, 28',
                'town' => 'Benidorm',
            ],

            // Zona 2: Alicante
            [
                'name' => 'Maigmo',
                'holder' => 'Jose Torres Moreno',
                'dni_cif' => '21415145Y',
                'address' => 'Ctra. Castalla A-213, Km 0,8',
                'town' => 'Tibi',
            ],
            [
                'name' => 'El Cantó',
                'holder' => 'Sisp Oe',
                'dni_cif' => 'E72541212',
                'address' => 'Ibi, 13 Bajo Izquierda L-1 Esc D',
                'town' => 'San Vicente',
            ],
            [
                'name' => 'Angel de Santa Pola',
                'holder' => 'Angel Ramon Rodenas Rico',
                'dni_cif' => '74235696E',
                'address' => 'Caridad, 26',
                'town' => 'Santa Pola',
            ],
            [
                'name' => 'Picaeta',
                'holder' => 'Francisco Rico Aliaga',
                'dni_cif' => '48343779X',
                'address' => 'Vicente Alexandre, 13 Urb. Res. Parque Lo Morant',
                'town' => 'Alicante',
            ],
            [
                'name' => 'Starkoffe',
                'holder' => 'Marcos Hernandez Pastor',
                'dni_cif' => '48627660W',
                'address' => 'C/ Maestro Latorre, 28 Bajo',
                'town' => 'Alicante',
            ],
            [
                'name' => 'Caballer',
                'holder' => 'Raquel Caballer Herrero',
                'dni_cif' => '48578283Y',
                'address' => 'C/ Xalo Edf, Las Mimosas Bloque 1 Locales A0-B0-F0-G0',
                'town' => 'Finestrat',
            ],
            [
                'name' => 'Bulevar',
                'holder' => 'Di Tella y Di Mare C.B.',
                'dni_cif' => 'E54167572',
                'address' => 'Deportista Kiko Sanchez, 1 Edif. Park Lane',
                'town' => 'Alicante',
            ],
            [
                'name' => 'Parada',
                'holder' => 'Arguirus Group, S.L',
                'dni_cif' => 'B56205727',
                'address' => 'C/ Isidoro de Sevilla, 44 Esquina Beato de Cadiz',
                'town' => 'Alicante',
            ],
            [
                'name' => 'D´Angelo',
                'holder' => 'Rio Vista S.L.U',
                'dni_cif' => 'B42620146',
                'address' => 'Gabriel y Galan, 1',
                'town' => 'Alicante',
            ],
            [
                'name' => 'De Aca y Alla',
                'holder' => 'Pulpo Investment S.L',
                'dni_cif' => 'B72451032',
                'address' => 'C/ Deportista Manuel Suarez, Local 1',
                'town' => 'Alicante',
            ],

            // Zona 3: Javea
            [
                'name' => 'Sport',
                'holder' => 'Maria Lucia Morales Lopez',
                'dni_cif' => '74005647L',
                'address' => 'Pza Ifach, 4 Edif. Garbimar, Esc 1 Bj Local 3, Entrada por C/ Jazmines, 8A',
                'town' => 'Calpe',
            ],
            [
                'name' => 'Mas y Mas',
                'holder' => 'Jose Vicente Navarro Todoli',
                'dni_cif' => '19988826D',
                'address' => 'Ctra. Valencia-Alicante, N-332, Km.164 (Ds Oqui, 31)',
                'town' => 'Pedreguer',
            ],

            // Zona 4: Denia
            [
                'name' => 'Casa Llauis',
                'holder' => 'Carlos Sanchez Soriano',
                'dni_cif' => '28992366S',
                'address' => 'Av/ de Gandia, 20, Esc 3 Local 4 Entrada por C/ Lliber',
                'town' => 'Denia',
            ],
            [
                'name' => 'Havanna',
                'holder' => 'Juan Carlos Hernandez Melia',
                'dni_cif' => '28992351T',
                'address' => 'C/ Patricio Ferrandiz, 69 Bajo Local 3 Entrada por C/ La Via 36 A',
                'town' => 'Denia',
            ],
            [
                'name' => 'Coratge',
                'holder' => 'Maria Angeles Femenia Rosello',
                'dni_cif' => '28994316X',
                'address' => 'Av/ Denia, 25',
                'town' => 'Beniarbeig',
            ],
            [
                'name' => 'Tramusser',
                'holder' => 'Luis Miguel Rivas Rivas',
                'dni_cif' => '11894404T',
                'address' => 'C/ Santa Ana Nº6 Bajo',
                'town' => 'Vall de L´Aguar',
            ],
            [
                'name' => 'Karma',
                'holder' => 'Ruben Ribes Garcia',
                'dni_cif' => '53217500P',
                'address' => 'C/ Segaria, 8 Esc. 1 Bajo Local 1',
                'town' => 'Ondara',
            ],
            [
                'name' => 'Madrigueres 64',
                'holder' => 'Gheorghe Alin Stanca',
                'dni_cif' => 'Z0112175D',
                'address' => 'Ptda Madrigueres Sud, 64A Local 1',
                'town' => 'Denia',
            ],

            // Zona 5: Taller
            [
                'name' => 'Bar 1 Taller',
                'holder' => 'xxx',
                'dni_cif' => 'xxxxx',
                'address' => 'xxxxxxxx',
                'town' => 'xxxxxxxxxx',
            ],
            [
                'name' => 'Bar 2 Taller',
                'holder' => 'xxx',
                'dni_cif' => 'xxxxx',
                'address' => 'xxxxxxxx',
                'town' => 'xxxxxxxxxx',
            ],
            [
                'name' => 'Bar 3 Taller',
                'holder' => 'xxx',
                'dni_cif' => 'xxxxx',
                'address' => 'xxxxxxxx',
                'town' => 'xxxxxxxxxx',
            ],
            [
                'name' => 'Bar 4 Taller',
                'holder' => 'xxx',
                'dni_cif' => 'xxxxx',
                'address' => 'xxxxxxxx',
                'town' => 'xxxxxxxxxx',
            ],
        ];

        // Recorremos los datos y creamos los registros correspondientes en la base de datos.
        collect($data)->each(function ($bar) {
            Bar::create([
                'name' => $bar['name'],
                'holder' => $bar['holder'],
                'dni_cif' => $bar['dni_cif'],
                'address' => $bar['address'],
                'town' => $bar['town'],
            ]);
        });
    }
}

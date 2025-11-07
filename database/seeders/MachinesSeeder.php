<?php

namespace Database\Seeders;

use App\Models\Bar;
use App\Models\Local;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Machine;


class MachinesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $maquinasSalones = [
            // DENIA /* actualizado 04/07/2025 */

            // Ejemplo de máquinas con tipo y relaciones específicas

            // Ruletas
            [
                'identificador' => 'B:SC6:25 V:110258',
                'nombre' => 'RULETA SPECTRA MERKUR 3000',
                'alias' => 'RULETA',
                'local' => 'Denia',
                'type' => 'roulette', // Especificamos que es una ruleta
                'children' => [
                    ['identificador' => 'B:SC6:251V:110258', 'nombre' => 'RULETA SPECTRA MERKUR 3000', 'alias' => 'RULETA PUESTO 1', 'local' => 'Denia'],
                    ['identificador' => 'B:SC6:252V:110258', 'nombre' => 'RULETA SPECTRA MERKUR 3000', 'alias' => 'RULETA PUESTO 1', 'local' => 'Denia'],
                    ['identificador' => 'B:SC6:253V:110258', 'nombre' => 'RULETA SPECTRA MERKUR 3000', 'alias' => 'RULETA PUESTO 1', 'local' => 'Denia'],
                    ['identificador' => 'B:SC6:254V:110258', 'nombre' => 'RULETA SPECTRA MERKUR 3000', 'alias' => 'RULETA PUESTO 1', 'local' => 'Denia'],
                    ['identificador' => 'B:SC6:255V:110258', 'nombre' => 'RULETA SPECTRA MERKUR 3000', 'alias' => 'RULETA PUESTO 1', 'local' => 'Denia'],
                    ['identificador' => 'B:SC6:256V:110258', 'nombre' => 'RULETA SPECTRA MERKUR 3000', 'alias' => 'RULETA PUESTO 1', 'local' => 'Denia'],

                ],
            ],

            // Máquinas sin relaciones específicas
            ['identificador' => 'B:GNQ:14 V:009662', 'alias' => 'GNOMOS MIX', 'nombre' => 'GNOMOS MIX 500', 'type' => 'single', 'local' => 'Denia'],
            ['identificador' => 'B:BLQ:16 V:016641', 'alias' => 'BURLESQUE', 'nombre' => 'BURLESQUE 500', 'type' => 'single', 'local' => 'Denia'],
            ['identificador' => 'B:MRM:25 V:000062', 'alias' => 'MANHATTAN', 'nombre' => 'MANHATTAN MIRAGE 1000', 'type' => 'single', 'local' => 'Denia'],
            ['identificador' => 'B:REY:19 V:003325', 'alias' => 'REY DE LA SUERTE', 'nombre' => 'REY DE LA SUERTE 500', 'type' => 'single', 'local' => 'Denia'],

            // Madre 1 (parent)
            [
                'identificador' => 'B:MB3:18 V:001845',
                'alias' => 'M-BOX',
                'nombre' => 'MERKUR BOX 1000',
                'local' => 'Denia',
                'type' => 'parent',
                'children' => [
                    ['identificador' => 'B:MB3:18AV:001845', 'alias' => 'M-BOX A', 'nombre' => 'MERKUR BOX 1000'],
                    ['identificador' => 'B:MB3:18BV:001845', 'alias' => 'M-BOX B', 'nombre' => 'MERKUR BOX 1000'],
                    ['identificador' => 'B:MB3:18CV:001845', 'alias' => 'M-BOX C', 'nombre' => 'MERKUR BOX 1000']
                ]
            ],

            // Madre 2 (parent)
            [
                'identificador' => 'B:MA3:21 V:103883',
                'alias' => 'M-MAX',
                'nombre' => 'MERKUR MAX 1000',
                'local' => 'Denia',
                'type' => 'parent',
                'children' => [
                    ['identificador' => 'B:MA3:21AV:103883', 'alias' => 'M-MAX A', 'nombre' => 'MERKUR MAX 1000'],
                    ['identificador' => 'B:MA3:21BV:103883', 'alias' => 'M-MAX B', 'nombre' => 'MERKUR MAX 1000'],
                    ['identificador' => 'B:MA3:21CV:103883', 'alias' => 'M-MAX C', 'nombre' => 'MERKUR MAX 1000']
                ]
            ],

            // Madre 3 (parent)
            [
                'identificador' => 'B:IX3:21 V:025090',
                'alias' => 'IMPERA',
                'nombre' => 'IMPERA LINK 1000',
                'local' => 'Denia',
                'type' => 'parent',
                'children' => [
                    ['identificador' => 'B:IX3:21AV:025090', 'alias' => 'IMPERA A', 'nombre' => 'IMPERA LINK 1000'],
                    ['identificador' => 'B:IX3:21BV:025090', 'alias' => 'IMPERA B', 'nombre' => 'IMPERA LINK 1000'],
                    ['identificador' => 'B:IX3:21CV:025090', 'alias' => 'IMPERA C', 'nombre' => 'IMPERA LINK 1000']
                ]
            ],

            // JAVEA /* actualizado 04/07/2025 */

            // Ruleta
            [
                'identificador' => 'B:RG8:18 V:000128',
                'nombre' => 'RULETA COMATEL 1000',
                'alias' => 'RULETA',
                'local' => 'Javea',
                'type' => 'roulette', // Especificamos que es una ruleta
                'children' => [
                    ['identificador' => 'B:RG8:181V:000128', 'nombre' => 'RULETA COMATEL 1000', 'alias' => 'RULETA PUESTO 1'],
                    ['identificador' => 'B:RG8:182V:000128', 'nombre' => 'RULETA COMATEL 1000', 'alias' => 'RULETA PUESTO 2'],
                    ['identificador' => 'B:RG8:183V:000128', 'nombre' => 'RULETA COMATEL 1000', 'alias' => 'RULETA PUESTO 3'],
                    ['identificador' => 'B:RG8:184V:000128', 'nombre' => 'RULETA COMATEL 1000', 'alias' => 'RULETA PUESTO 4'],
                    ['identificador' => 'B:RG8:185V:000128', 'nombre' => 'RULETA COMATEL 1000', 'alias' => 'RULETA PUESTO 5'],
                    ['identificador' => 'B:RG8:186V:000128', 'nombre' => 'RULETA COMATEL 1000', 'alias' => 'RULETA PUESTO 6'],
                    ['identificador' => 'B:RG8:187V:000128', 'nombre' => 'RULETA COMATEL 1000', 'alias' => 'RULETA PUESTO 7'],
                    ['identificador' => 'B:RG8:188V:000128', 'nombre' => 'RULETA COMATEL 1000', 'alias' => 'RULETA PUESTO 8']
                ]
            ],

            ['identificador' => 'B:CHM:18 V:002828', 'alias' => 'CHIRINGUITO', 'nombre' => 'CHIRINGUITO SALON1000', 'type' => 'single', 'local' => 'Javea'],
            ['identificador' => 'B:NEQ:16 V:003802', 'alias' => 'NEOPOLIS', 'nombre' => 'NEOPOLIS 500', 'type' => 'single', 'local' => 'Javea'],

            // Máquinas madre con hijos
            [
                'identificador' => 'B:MB3:18 V:001853',
                'alias' => 'M-BOX',
                'nombre' => 'MERKUR-BOX 100',
                'local' => 'Javea',
                'type' => 'parent',
                'children' => [
                    ['identificador' => 'B:MB3:18AV:001853', 'alias' => 'M-BOX A', 'nombre' => 'MERKUR-BOX 100', 'local' => 'Javea'],
                    ['identificador' => 'B:MB3:18BV:001853', 'alias' => 'M-BOX B', 'nombre' => 'MERKUR-BOX 100', 'local' => 'Javea'],
                    ['identificador' => 'B:MB3:18CV:001853', 'alias' => 'M-BOX C', 'nombre' => 'MERKUR-BOX 100', 'local' => 'Javea']
                ]
            ],
            [
                'identificador' => 'B:PN3:20 V:021128',
                'alias' => 'POWER LINK',
                'nombre' => 'POWER LINK 1000',
                'local' => 'Javea',
                'type' => 'parent',
                'children' => [
                    ['identificador' => 'B:PN3:20AV:021128', 'alias' => 'POWER LINK A', 'nombre' => 'POWER LINK 1000', 'local' => 'Javea'],
                    ['identificador' => 'B:PN3:20BV:021128', 'alias' => 'POWER LINK B', 'nombre' => 'POWER LINK 1000', 'local' => 'Javea'],
                    ['identificador' => 'B:PN3:20CV:021128', 'alias' => 'POWER LINK C', 'nombre' => 'POWER LINK 1000', 'local' => 'Javea']
                ]
            ],
            [
                'identificador' => 'B:IX3:21 V:024244',
                'alias' => 'IMPERA',
                'nombre' => 'IMPERA LINK 1000',
                'local' => 'Javea',
                'type' => 'parent',
                'children' => [
                    ['identificador' => 'B:IX3:21AV:024244', 'alias' => 'IMPERA A', 'nombre' => 'IMPERA LINK 1000', 'local' => 'Javea'],
                    ['identificador' => 'B:IX3:21BV:024244', 'alias' => 'IMPERA B', 'nombre' => 'IMPERA LINK 1000', 'local' => 'Javea'],
                    ['identificador' => 'B:IX3:21CV:024244', 'alias' => 'IMPERA C', 'nombre' => 'IMPERA LINK 1000', 'local' => 'Javea']
                ]
            ],
            [
                'identificador' => 'B:MA3:21 V:104193',
                'alias' => 'M-MAX',
                'nombre' => 'MERKUR MAX 3000',
                'local' => 'Javea',
                'type' => 'parent',
                'children' => [
                    ['identificador' => 'B:MA3:21AV:104193', 'alias' => 'M-MAX A', 'nombre' => 'MERKUR MAX 3000', 'local' => 'Javea'],
                    ['identificador' => 'B:MA3:21BV:104193', 'alias' => 'M-MAX B', 'nombre' => 'MERKUR MAX 3000', 'local' => 'Javea'],
                    ['identificador' => 'B:MA3:21CV:104193', 'alias' => 'M-MAX C', 'nombre' => 'MERKUR MAX 3000', 'local' => 'Javea']
                ]
            ],
            [
                'identificador' => 'B:AS3:18 V:000045',
                'alias' => 'ACTION STAR',
                'nombre' => 'ACTION STAR 1000',
                'local' => 'Javea',
                'type' => 'parent',
                'children' => [
                    ['identificador' => 'B:AS3:18AV:000045', 'alias' => 'ACTION STAR A', 'nombre' => 'ACTION STAR 1000', 'local' => 'Javea'],
                    ['identificador' => 'B:AS3:18BV:000045', 'alias' => 'ACTION STAR B', 'nombre' => 'ACTION STAR 1000', 'local' => 'Javea'],
                    ['identificador' => 'B:AS3:18CV:000045', 'alias' => 'ACTION STAR C', 'nombre' => 'ACTION STAR 1000', 'local' => 'Javea']
                ]
            ],
            [
                'identificador' => 'B:LT3:23 V:001327',
                'alias' => 'LINK MASTER',
                'nombre' => 'LINK MASTER 3000',
                'local' => 'Javea',
                'type' => 'parent',
                'children' => [
                    ['identificador' => 'B:LT3:23AV:001327', 'alias' => 'LINK MASTER A', 'nombre' => 'LINK MASTER 3000', 'local' => 'Javea'],
                    ['identificador' => 'B:LT3:23BV:001327', 'alias' => 'LINK MASTER B', 'nombre' => 'LINK MASTER 3000', 'local' => 'Javea'],
                    ['identificador' => 'B:LT3:23CV:001327', 'alias' => 'LINK MASTER C', 'nombre' => 'LINK MASTER 3000', 'local' => 'Javea']
                ]
            ],

            // JAIME SEGARRA /* actualizado 04/07/2025 */

            [
                'identificador' => 'B:RJ8:21 V:000047',
                'nombre' => 'RULETA COMATEL 1000',
                'alias' => 'RULETA',
                'local' => 'Jaime Segarra',
                'type' => 'roulette', // Especificamos que es una ruleta
                'children' => [
                    ['identificador' => 'B:RJ8:211V:000047', 'nombre' => 'RULETA COMATEL 1000', 'alias' => 'RULETA PUESTO 1', 'local' => 'Jaime Segarra'],
                    ['identificador' => 'B:RJ8:212V:000047', 'nombre' => 'RULETA COMATEL 1000', 'alias' => 'RULETA PUESTO 2', 'local' => 'Jaime Segarra'],
                    ['identificador' => 'B:RJ8:213V:000047', 'nombre' => 'RULETA COMATEL 1000', 'alias' => 'RULETA PUESTO 3', 'local' => 'Jaime Segarra'],
                    ['identificador' => 'B:RJ8:214V:000047', 'nombre' => 'RULETA COMATEL 1000', 'alias' => 'RULETA PUESTO 4', 'local' => 'Jaime Segarra'],
                    ['identificador' => 'B:RJ8:215V:000047', 'nombre' => 'RULETA COMATEL 1000', 'alias' => 'RULETA PUESTO 5', 'local' => 'Jaime Segarra'],
                    ['identificador' => 'B:RJ8:216V:000047', 'nombre' => 'RULETA COMATEL 1000', 'alias' => 'RULETA PUESTO 6', 'local' => 'Jaime Segarra'],
                    ['identificador' => 'B:RJ8:217V:000047', 'nombre' => 'RULETA COMATEL 1000', 'alias' => 'RULETA PUESTO 7', 'local' => 'Jaime Segarra'],
                    ['identificador' => 'B:RJ8:218V:000047', 'nombre' => 'RULETA COMATEL 1000', 'alias' => 'RULETA PUESTO 8', 'local' => 'Jaime Segarra'],
                ],
            ],

            // Máquinas sin relaciones específicas
            ['identificador' => 'B:GNM:06 V:007854', 'alias' => 'GNOMOS', 'nombre' => 'GNOMO TRIPLE 240', 'type' => 'single', 'local' => 'Jaime Segarra'],
            ['identificador' => 'B:MRM:25 V:000063', 'alias' => 'MANHATTAN', 'nombre' => 'MANHATTAN MIRAGE 1000', 'type' => 'single', 'local' => 'Jaime Segarra'],
            ['identificador' => 'B:WOT:12 V:000193', 'alias' => 'WOONSTERS', 'nombre' => 'GIGAMES WOONSTERS SALON 500', 'type' => 'single', 'local' => 'Jaime Segarra'],
            ['identificador' => 'B:GNQ:14 V:007844', 'alias' => 'GNOMOS MIX', 'nombre' => 'GNOMOS MIX 500', 'type' => 'single', 'local' => 'Jaime Segarra'],
            ['identificador' => 'B:BLQ:16 V:016630', 'alias' => 'BURLESQUE', 'nombre' => 'BURLESQUE 500', 'type' => 'single', 'local' => 'Jaime Segarra'],

            // ACTION STAR (parent)
            [
                'identificador' => 'B:AS3:17 V:000029',
                'alias' => 'ACTION STAR',
                'nombre' => 'ACTION STAR 1000',
                'local' => 'Jaime Segarra',
                'type' => 'parent',
                'children' => [
                    ['identificador' => 'B:AS3:17AV:000029', 'alias' => 'ACTION STAR A', 'nombre' => 'ACTION STAR 1000'],
                    ['identificador' => 'B:AS3:17BV:000029', 'alias' => 'ACTION STAR B', 'nombre' => 'ACTION STAR 1000'],
                    ['identificador' => 'B:AS3:17CV:000029', 'alias' => 'ACTION STAR C', 'nombre' => 'ACTION STAR 1000']
                ]
            ],

            // Máquinas con relaciones "parent" e "hijo" (LINK MASTER)
            [
                'identificador' => 'B:LT3:23 V:001328',
                'alias' => 'LINK MASTER',
                'nombre' => 'LINK MASTER 3000',
                'local' => 'Jaime Segarra',
                'type' => 'parent',
                'children' => [
                    ['identificador' => 'B:LT3:23AV:001328', 'alias' => 'LINK MASTER A', 'nombre' => 'LINK MASTER 3000'],
                    ['identificador' => 'B:LT3:23BV:001328', 'alias' => 'LINK MASTER B', 'nombre' => 'LINK MASTER 3000'],
                    ['identificador' => 'B:LT3:23CV:001328', 'alias' => 'LINK MASTER C', 'nombre' => 'LINK MASTER 3000']
                ]
            ],

            // Máquinas con relaciones "parent" e "hijo" (M-BOX)
            [
                'identificador' => 'B:MB3:18 V:001862',
                'alias' => 'M-BOX',
                'nombre' => 'MERKUR BOX 1000',
                'local' => 'Jaime Segarra',
                'type' => 'parent',
                'children' => [
                    ['identificador' => 'B:MB3:18AV:001862', 'alias' => 'M-BOX A', 'nombre' => 'MERKUR BOX 1000'],
                    ['identificador' => 'B:MB3:18BV:001862', 'alias' => 'M-BOX B', 'nombre' => 'MERKUR BOX 1000'],
                    ['identificador' => 'B:MB3:18CV:001862', 'alias' => 'M-BOX C', 'nombre' => 'MERKUR BOX 1000']
                ]
            ],

            // Máquinas con relaciones "parent" e "hijo" (ZITRO)
            [
                'identificador' => 'B:MK3:19 V:003525',
                'alias' => 'ZITRO',
                'nombre' => 'MULTILINK 1000',
                'local' => 'Jaime Segarra',
                'type' => 'parent',
                'children' => [
                    ['identificador' => 'B:MK3:19AV:003525', 'alias' => 'ZITRO A', 'nombre' => 'MULTILINK 1000'],
                    ['identificador' => 'B:MK3:19BV:003525', 'alias' => 'ZITRO B', 'nombre' => 'MULTILINK 1000'],
                    ['identificador' => 'B:MK3:19CV:003525', 'alias' => 'ZITRO C', 'nombre' => 'MULTILINK 1000']
                ]
            ],

            // Máquinas con relaciones "parent" e "hijo" (IMPERA)
            [
                'identificador' => 'B:MK3:19 V:003525',
                'alias' => 'IMPERA',
                'nombre' => 'IMPERA LINK 3000',
                'local' => 'Jaime Segarra',
                'type' => 'parent',
                'children' => [
                    ['identificador' => 'B:MK3:19AV:003525', 'alias' => 'IMPERA A', 'nombre' => 'MULTILINK 3000'],
                    ['identificador' => 'B:MK3:19BV:003525', 'alias' => 'IMPERA B', 'nombre' => 'MULTILINK 3000'],
                    ['identificador' => 'B:MK3:19CV:003525', 'alias' => 'IMPERA C', 'nombre' => 'MULTILINK 3000']
                ]
            ],

            // Máquinas con relaciones "parent" e "hijo" (SOLAR LINK)
            [
                'identificador' => 'B:SL3:22 V:105747',
                'alias' => 'M-SOLAR',
                'nombre' => 'SOLAR LINK 3000',
                'local' => 'Jaime Segarra',
                'type' => 'parent',
                'children' => [
                    ['identificador' => 'B:SL3:22AV:105747', 'alias' => 'M-SOLAR A', 'nombre' => 'SOLARLINK 3000'],
                    ['identificador' => 'B:SL3:22BV:105747', 'alias' => 'M-SOLAR B', 'nombre' => 'SOLARLINK 3000'],
                    ['identificador' => 'B:SL3:22CV:105747', 'alias' => 'M-SOLAR C', 'nombre' => 'SOLARLINK 3000']
                ]
            ],

            // Máquinas con relaciones "parent" e "hijo" (ISLA ICE)
            [
                'identificador' => 'B:RK3:24 V:001131',
                'alias' => 'ROCKET',
                'nombre' => 'ISLA ROCKET 3000',
                'local' => 'Jaime Segarra',
                'type' => 'parent',
                'children' => [
                    ['identificador' => 'B:RK3:24AV:001131', 'alias' => 'ROCKET A', 'nombre' => 'ISLA ROCKET 3000'],
                    ['identificador' => 'B:RK3:24BV:001131', 'alias' => 'ROCKET B', 'nombre' => 'ISLA ROCKET 3000'],
                    ['identificador' => 'B:RK3:24CV:001131', 'alias' => 'ROCKET C', 'nombre' => 'ISLA ROCKET 3000']
                ]
            ],

            // VILLAJOYOSA /* actualizado 04/07/2025 */

            // Ruleta
            [
                'identificador' => 'B:GX8:23 V:000096',
                'nombre' => 'RULETA INFINITY 3000',
                'alias' => 'RULETA',
                'local' => 'Villajoyosa',
                'type' => 'roulette', // Especificamos que es una ruleta
                'children' => [
                    ['identificador' => 'B:GX8:231V:000096', 'nombre' => 'RULETA INFINITY 3000', 'alias' => 'RULETA PUESTO 1', 'local' => 'Villajoyosa'],
                ],
            ],

            // Máquinas sin relaciones específicas
            ['identificador' => 'B:SFL:07 V:002244', 'alias' => 'SANTA FE', 'nombre' => 'SANTA FE LOTO TRIPLE 240', 'type' => 'single', 'local' => 'Villajoyosa'],
            ['identificador' => 'B:WOT:12 V:000202', 'alias' => 'WOONSTERS', 'nombre' => 'GIGAMES WOONSTERS SALON 500', 'type' => 'single', 'local' => 'Villajoyosa'],
            ['identificador' => 'B:DOQ:16 V:016642', 'alias' => 'DORADO', 'nombre' => 'EL DORADO 500', 'type' => 'single', 'local' => 'Villajoyosa'],
            ['identificador' => 'B:BLQ:16 V:016642', 'alias' => 'BURLESQUE', 'nombre' => 'BURLESQUE 500', 'type' => 'single', 'local' => 'Villajoyosa'],

            // ACTION STAR (parent)
            [
                'identificador' => 'B:AS3:17 V:000033',
                'alias' => 'ACTION STAR',
                'nombre' => 'ACTION STAR 600',
                'local' => 'Villajoyosa',
                'type' => 'parent',
                'children' => [
                    ['identificador' => 'B:AS3:17AV:000033', 'alias' => 'ACTION STAR A', 'nombre' => 'ACTION STAR 600'],
                    ['identificador' => 'B:AS3:17BV:000033', 'alias' => 'ACTION STAR B', 'nombre' => 'ACTION STAR 600'],
                    ['identificador' => 'B:AS3:17CV:000033', 'alias' => 'ACTION STAR C', 'nombre' => 'ACTION STAR 600']
                ]
            ],

            // MERKUR BOX (parent)
            [
                'identificador' => 'B:MB3:18 V:001850',
                'alias' => 'M-BOX',
                'nombre' => 'MERKUR BOX 600',
                'local' => 'Villajoyosa',
                'type' => 'parent',
                'children' => [
                    ['identificador' => 'B:MB3:18AV:001850', 'alias' => 'M-BOX A', 'nombre' => 'MERKUR BOX 600'],
                    ['identificador' => 'B:MB3:18BV:001850', 'alias' => 'M-BOX B', 'nombre' => 'MERKUR BOX 600'],
                    ['identificador' => 'B:MB3:18CV:001850', 'alias' => 'M-BOX C', 'nombre' => 'MERKUR BOX 600']
                ]
            ],

            // POWER LINK (parent)
            [
                'identificador' => 'B:PT3:21 V:025244',
                'alias' => 'POWER LINK',
                'nombre' => 'POWER LINK 3000',
                'local' => 'Villajoyosa',
                'type' => 'parent',
                'children' => [
                    ['identificador' => 'B:PT3:21AV:025244', 'alias' => 'POWER LINK A', 'nombre' => 'POWER LINK 3000'],
                    ['identificador' => 'B:PT3:21BV:025244', 'alias' => 'POWER LINK B', 'nombre' => 'POWER LINK 3000'],
                    ['identificador' => 'B:PT3:21CV:025244', 'alias' => 'POWER LINK C', 'nombre' => 'POWER LINK 3000']
                ]
            ],

            // DIAMOND (parent)
            [
                'identificador' => 'B:DI3:24 V:0002M96',
                'alias' => 'DIAMOND',
                'nombre' => 'DIAMOND MANIA 3000',
                'local' => 'Villajoyosa',
                'type' => 'parent',
                'children' => [
                    ['identificador' => 'B:DI3:24AV:000296', 'alias' => 'DIAMOND A', 'nombre' => 'DIAMOND MANIA 3000'],
                    ['identificador' => 'B:DI3:24BV:000296', 'alias' => 'DIAMOND B', 'nombre' => 'DIAMOND MANIA 3000'],
                    ['identificador' => 'B:DI3:24CV:000296', 'alias' => 'DIAMOND C', 'nombre' => 'DIAMOND MANIA 3000']
                ]
            ],

            // ONDARA /* actualizado 04/07/2025 */

            // Ruletas
            [
                'identificador' => 'B:RG8:22 V:000056',
                'nombre' => 'RULETA COMATEL 1000',
                'alias' => 'RULETA',
                'local' => 'Ondara',
                'type' => 'roulette', // Especificamos que es una ruleta
                'children' => [
                    ['identificador' => 'B:RG8:221V:000056', 'nombre' => 'RULETA COMATEL 1000', 'alias' => 'RULETA PUESTO 1', 'local' => 'Ondara'],
                    ['identificador' => 'B:RG8:222V:000056', 'nombre' => 'RULETA COMATEL 1000', 'alias' => 'RULETA PUESTO 2', 'local' => 'Ondara'],
                    ['identificador' => 'B:RG8:223V:000056', 'nombre' => 'RULETA COMATEL 1000', 'alias' => 'RULETA PUESTO 3', 'local' => 'Ondara'],
                    ['identificador' => 'B:RG8:224V:000056', 'nombre' => 'RULETA COMATEL 1000', 'alias' => 'RULETA PUESTO 4', 'local' => 'Ondara'],
                    ['identificador' => 'B:RG8:225V:000056', 'nombre' => 'RULETA COMATEL 1000', 'alias' => 'RULETA PUESTO 5', 'local' => 'Ondara'],
                    ['identificador' => 'B:RG8:226V:000056', 'nombre' => 'RULETA COMATEL 1000', 'alias' => 'RULETA PUESTO 6', 'local' => 'Ondara'],
                    ['identificador' => 'B:RG8:227V:000056', 'nombre' => 'RULETA COMATEL 1000', 'alias' => 'RULETA PUESTO 7', 'local' => 'Ondara'],
                    ['identificador' => 'B:RG8:228V:000056', 'nombre' => 'RULETA COMATEL 1000', 'alias' => 'RULETA PUESTO 8', 'local' => 'Ondara'],
                ],
            ],
            // Máquinas sin relaciones específicas
            ['identificador' => 'B:WOT:12 V:000199', 'alias' => 'WOONSTER', 'nombre' => 'GIGAMES WOONSTERS SALON 500', 'type' => 'single', 'local' => 'Ondara'],
            ['identificador' => 'B:AP1:24 V:000008', 'alias' => 'APOLO', 'nombre' => 'APOLLO GAMES SALON', 'type' => 'single', 'local' => 'Ondara'],
            ['identificador' => 'B:DOQ:16 V:017581', 'alias' => 'DORADO', 'nombre' => 'EL DORADO 500', 'type' => 'single', 'local' => 'Ondara'],
            ['identificador' => 'B:MTQ:16 V:000397', 'alias' => 'MAQUINA DEL TIEMPO', 'nombre' => 'MAQUINA DEL TIEMPO 500', 'type' => 'single', 'local' => 'Ondara'],

            // ACTION STAR (parent)
            [
                'identificador' => 'B:AS3:17 V:000030',
                'alias' => 'ACTION STAR',
                'nombre' => 'ACTION STAR 1000',
                'local' => 'Ondara',
                'type' => 'parent',
                'children' => [
                    ['identificador' => 'B:AS3:17AV:000030', 'alias' => 'ACTION STAR A', 'nombre' => 'ACTION STAR 1000'],
                    ['identificador' => 'B:AS3:17BV:000030', 'alias' => 'ACTION STAR B', 'nombre' => 'ACTION STAR 1000'],
                    ['identificador' => 'B:AS3:17CV:000030', 'alias' => 'ACTION STAR C', 'nombre' => 'ACTION STAR 1000']
                ]
            ],

            // MERKUR III (parent)
            [
                'identificador' => 'B:M33:16 V:000938',
                'alias' => 'MERKUR III',
                'nombre' => 'MERKUR III 600',
                'local' => 'Ondara',
                'type' => 'parent',
                'children' => [
                    ['identificador' => 'B:M33:16 V:000938', 'alias' => 'MERKUR III A', 'nombre' => 'MERKUR III 600'],
                    ['identificador' => 'B:M33:16 V:000938', 'alias' => 'MERKUR III B', 'nombre' => 'MERKUR III 600'],
                    ['identificador' => 'B:M33:16 V:000938', 'alias' => 'MERKUR III C', 'nombre' => 'MERKUR III 600']
                ]
            ],

            // POWER LINK (parent)
            [
                'identificador' => 'B:PN3:20 V:021134',
                'alias' => 'POWER LINK',
                'nombre' => 'POWER LINK 1000',
                'local' => 'Ondara',
                'type' => 'parent',
                'children' => [
                    ['identificador' => 'B:PN3:20AV:021134', 'alias' => 'POWER LINK A', 'nombre' => 'POWER LINK 1000'],
                    ['identificador' => 'B:PN3:20BV:021134', 'alias' => 'POWER LINK B', 'nombre' => 'POWER LINK 1000'],
                    ['identificador' => 'B:PN3:20CV:021134', 'alias' => 'POWER LINK C', 'nombre' => 'POWER LINK 1000']
                ]
            ],

            // IMPERA (parent)
            [
                'identificador' => 'B:IX3:21 V:024245',
                'alias' => 'IMPERA',
                'nombre' => 'IMPERA LINK 3000',
                'local' => 'Ondara',
                'type' => 'parent',
                'children' => [
                    ['identificador' => 'B:IX3:21AV:024245', 'alias' => 'IMPERA A', 'nombre' => 'IMPERA LINK 3000'],
                    ['identificador' => 'B:IX3:21BV:024245', 'alias' => 'IMPERA B', 'nombre' => 'IMPERA LINK 3000'],
                    ['identificador' => 'B:IX3:21CV:024245', 'alias' => 'IMPERA C', 'nombre' => 'IMPERA LINK 3000']
                ]
            ],

            // ZITRO (parent)
            [
                'identificador' => 'B:MK3:24 V:013348',
                'alias' => 'ZITRO',
                'nombre' => 'MULTILINK 1000',
                'local' => 'Ondara',
                'type' => 'parent',
                'children' => [
                    ['identificador' => 'B:MK3:24AV:013348', 'alias' => 'ZITRO A', 'nombre' => 'MULTILINK 1000'],
                    ['identificador' => 'B:MK3:24BV:013348', 'alias' => 'ZITRO B', 'nombre' => 'MULTILINK 1000'],
                    ['identificador' => 'B:MK3:24CV:013348', 'alias' => 'ZITRO C', 'nombre' => 'MULTILINK 1000']
                ]
            ],

            // PARDO GIMENO /* actualizado 04/07/2025 */

            // Ruletas
            [
                'identificador' => 'B:RG8:20 V:000033',
                'nombre' => 'RULETA COMATEL 1000',
                'alias' => 'RULETA',
                'local' => 'Pardo Gimeno',
                'type' => 'roulette', // Especificamos que es una ruleta
                'children' => [
                    ['identificador' => 'B:RG8:201V:000033', 'nombre' => 'RULETA COMATEL 1000', 'alias' => 'RULETA PUESTO 1', 'local' => 'Pardo Gimeno'],
                    ['identificador' => 'B:RG8:202V:000033', 'nombre' => 'RULETA COMATEL 1000', 'alias' => 'RULETA PUESTO 2', 'local' => 'Pardo Gimeno'],
                    ['identificador' => 'B:RG8:203V:000033', 'nombre' => 'RULETA COMATEL 1000', 'alias' => 'RULETA PUESTO 3', 'local' => 'Pardo Gimeno'],
                    ['identificador' => 'B:RG8:204V:000033', 'nombre' => 'RULETA COMATEL 1000', 'alias' => 'RULETA PUESTO 4', 'local' => 'Pardo Gimeno'],
                    ['identificador' => 'B:RG8:205V:000033', 'nombre' => 'RULETA COMATEL 1000', 'alias' => 'RULETA PUESTO 5', 'local' => 'Pardo Gimeno'],
                    ['identificador' => 'B:RG8:206V:000033', 'nombre' => 'RULETA COMATEL 1000', 'alias' => 'RULETA PUESTO 6', 'local' => 'Pardo Gimeno'],
                    ['identificador' => 'B:RG8:207V:000033', 'nombre' => 'RULETA COMATEL 1000', 'alias' => 'RULETA PUESTO 7', 'local' => 'Pardo Gimeno'],
                    ['identificador' => 'B:RG8:208V:000033', 'nombre' => 'RULETA COMATEL 1000', 'alias' => 'RULETA PUESTO 8', 'local' => 'Pardo Gimeno'],
                ],
            ],

            // Máquinas sin relaciones específicas
            ['identificador' => 'B:CHM:18 V:002827', 'alias' => 'CHIRINGUITO', 'nombre' => 'CHIRINGUITO SALON 1000', 'type' => 'single', 'local' => 'Pardo Gimeno'],
            ['identificador' => 'B:MMU:19 V:100357', 'alias' => 'MERKUR MULTI', 'nombre' => 'MERKUR MULTI 500', 'type' => 'single', 'local' => 'Pardo Gimeno'],
            ['identificador' => 'B:MMS:22 V:104644', 'alias' => 'MERKUR MULTI SELECCION', 'nombre' => 'MERKUR MULTI SELECTION', 'type' => 'single', 'local' => 'Pardo Gimeno'],
            ['identificador' => 'B:PAM:24 V:000082', 'alias' => 'MANHATTAN', 'nombre' => 'MANHATTAN PARTY SALON 1000', 'type' => 'single', 'local' => 'Pardo Gimeno'],
            ['identificador' => 'B:LME:23 V:068891', 'alias' => 'LINK ME A', 'nombre' => 'LINK ME 1000', 'type' => 'single', 'local' => 'Pardo Gimeno'],
            ['identificador' => 'B:LME:23 V:068892', 'alias' => 'LINK ME B', 'nombre' => 'LINK ME 1000', 'type' => 'single', 'local' => 'Pardo Gimeno'],

            // NUEVA
            [
                'identificador' => 'B:DI3:24 V:000779',
                'alias' => 'DIAMOND',
                'nombre' => 'DIAMOND MANIA 3000',
                'local' => 'Pardo Gimeno',
                'type' => 'parent',
                'children' => [
                    ['identificador' => 'B:DI3:24AV:000779', 'alias' => 'DIAMOND A', 'nombre' => 'DIAMOND MANIA 3000'],
                    ['identificador' => 'B:DI3:24BV:000779', 'alias' => 'DIAMOND B', 'nombre' => 'DIAMOND MANIA 3000'],
                    ['identificador' => 'B:DI3:24CV:000779', 'alias' => 'DIAMOND C', 'nombre' => 'DIAMOND MANIA 3000']
                ]
            ],

            // IMPERA (parent)
            [
                'identificador' => 'B:IL3:18 V:011594',
                'alias' => 'IMPERA',
                'nombre' => 'IMPERA 1000',
                'local' => 'Pardo Gimeno',
                'type' => 'parent',
                'children' => [
                    ['identificador' => 'B:IL3:18AV:011594', 'alias' => 'IMPERA A', 'nombre' => 'IMPERA 1000'],
                    ['identificador' => 'B:IL3:18BV:011594', 'alias' => 'IMPERA B', 'nombre' => 'IMPERA 1000'],
                    ['identificador' => 'B:IL3:18CV:011594', 'alias' => 'IMPERA C', 'nombre' => 'IMPERA 1000']
                ]
            ],

            // ZITRO (parent)
            [
                'identificador' => 'B:MK3:23 V:011246',
                'alias' => 'ZITRO',
                'nombre' => 'MULTILINK 1000',
                'local' => 'Pardo Gimeno',
                'type' => 'parent',
                'children' => [
                    ['identificador' => 'B:MK3:23AV:011246', 'alias' => 'ZITRO A', 'nombre' => 'MULTILINK 1000'],
                    ['identificador' => 'B:MK3:23BV:011246', 'alias' => 'ZITRO B', 'nombre' => 'MULTILINK 1000'],
                    ['identificador' => 'B:MK3:23CV:011246', 'alias' => 'ZITRO C', 'nombre' => 'MULTILINK 1000']
                ]
            ],

            // LINK MASTER (parent)
            [
                'identificador' => 'B:LT3:23 V:001150',
                'alias' => 'LINK MASTER',
                'nombre' => 'LINK MASTER 3000',
                'local' => 'Pardo Gimeno',
                'type' => 'parent',
                'children' => [
                    ['identificador' => 'B:LT3:23AV:001150', 'alias' => 'LINK MASTER A', 'nombre' => 'LINK MASTER 3000'],
                    ['identificador' => 'B:LT3:23BV:001150', 'alias' => 'LINK MASTER B', 'nombre' => 'LINK MASTER 3000'],
                    ['identificador' => 'B:LT3:23CV:001150', 'alias' => 'LINK MASTER C', 'nombre' => 'LINK MASTER 3000']
                ]
            ],

            // ROCKET LINK (parent)
            /*[
                'identificador' => 'B:RK3:23 V:004644',
                'alias' => 'ROCKET',
                'nombre' => 'ISLA ROCKET 3000',
                'local' => 'Pardo Gimeno',
                'type' => 'parent',
                'children' => [
                    ['identificador' => 'B:RK3:23AV:004644', 'alias' => 'ROCKET A', 'nombre' => 'ISLA ROCKET 3000'],
                    ['identificador' => 'B:RK3:23BV:004644', 'alias' => 'ROCKET B', 'nombre' => 'ISLA ROCKET 3000'],
                    ['identificador' => 'B:RK3:23CV:004644', 'alias' => 'ROCKET C', 'nombre' => 'ISLA ROCKET 3000']
                ]
            ],*/

            // Máquinas con relaciones "parent" e "hijo" (ISLA ICE)
            [
                'identificador' => 'B:IC3:25 V:001582',
                'alias' => 'ICE-FIRE',
                'nombre' => 'ISLA ICE AND FIRE 3000',
                'local' => 'Pardo Gimeno',
                'type' => 'parent',
                'children' => [
                    ['identificador' => 'B:IC3:25AV:001582', 'alias' => 'ICE-FIRE A', 'nombre' => 'ISLA ICE AND FIRE 3000'],
                    ['identificador' => 'B:IC3:25BV:001582', 'alias' => 'ICE-FIRE B', 'nombre' => 'ISLA ICE AND FIRE 3000'],
                    ['identificador' => 'B:IC3:25CV:001582', 'alias' => 'ICE-FIRE C', 'nombre' => 'ISLA ICE AND FIRE 3000']
                ]
            ],

            // MUCHAMIEL /* actualizado 04/07/2025 */

            // Ruletas
            [
                'identificador' => 'B:SC6:25 V:109773',
                'nombre' => 'RULETA SPECTRA MERKUR 3000',
                'alias' => 'RULETA',
                'local' => 'Muchamiel',
                'type' => 'roulette', // Especificamos que es una ruleta
                'children' => [
                    ['identificador' => 'B:SC6:251V:109773', 'nombre' => 'RULETA SPECTRA MERKUR 3000', 'alias' => 'RULETA PUESTO 1', 'local' => 'Muchamiel'],
                    ['identificador' => 'B:SC6:252V:109773', 'nombre' => 'RULETA SPECTRA MERKUR 3000', 'alias' => 'RULETA PUESTO 1', 'local' => 'Muchamiel'],
                    ['identificador' => 'B:SC6:253V:109773', 'nombre' => 'RULETA SPECTRA MERKUR 3000', 'alias' => 'RULETA PUESTO 1', 'local' => 'Muchamiel'],
                    ['identificador' => 'B:SC6:254V:109773', 'nombre' => 'RULETA SPECTRA MERKUR 3000', 'alias' => 'RULETA PUESTO 1', 'local' => 'Muchamiel'],
                    ['identificador' => 'B:SC6:255V:109773', 'nombre' => 'RULETA SPECTRA MERKUR 3000', 'alias' => 'RULETA PUESTO 1', 'local' => 'Muchamiel'],
                    ['identificador' => 'B:SC6:256V:109773', 'nombre' => 'RULETA SPECTRA MERKUR 3000', 'alias' => 'RULETA PUESTO 1', 'local' => 'Muchamiel'],
                ],
            ],

            // Máquinas sin relaciones específicas
            ['identificador' => 'B:NEQ:15 V:008590', 'alias' => 'NEOPOLIS', 'nombre' => 'NEOPOLIS 500', 'type' => 'single', 'local' => 'Muchamiel'],
            ['identificador' => 'B:MMU:19 V:100353', 'alias' => 'MERKUR MULTI', 'nombre' => 'MERKUR MULTI 500', 'type' => 'single', 'local' => 'Muchamiel'],
            ['identificador' => 'B:MRM:25 V:000064', 'alias' => 'MANHATTAN', 'nombre' => 'MANHATTAN MIRAGE 1000', 'type' => 'single', 'local' => 'Muchamiel'],

            // ACTION STAR (parent)
            [
                'identificador' => 'B:RO3:25 V:006221',
                'alias' => 'ROYAL LINK',
                'nombre' => 'ROYAL LINK 3000',
                'local' => 'Muchamiel',
                'type' => 'parent',
                'children' => [
                    ['identificador' => 'B:RO3:25AV:006221', 'alias' => 'ROYAL LINK A', 'nombre' => 'ROYAL LINK 3000'],
                    ['identificador' => 'B:RO3:25BV:006221', 'alias' => 'ROYAL LINK B', 'nombre' => 'ROYAL LINK 3000'],
                    ['identificador' => 'B:RO3:25CV:006221', 'alias' => 'ROYAL LINK C', 'nombre' => 'ROYAL LINK 3000']
                ]
            ],

            // IMPERA (parent)
            [
                'identificador' => 'B:IX3:21 V:024246',
                'alias' => 'IMPERA',
                'nombre' => 'IMPERA 3000',
                'local' => 'Muchamiel',
                'type' => 'parent',
                'children' => [
                    ['identificador' => 'B:IX3:21AV:024246', 'alias' => 'IMPERA A', 'nombre' => 'IMPERA 3000'],
                    ['identificador' => 'B:IX3:21BV:024246', 'alias' => 'IMPERA B', 'nombre' => 'IMPERA 3000'],
                    ['identificador' => 'B:IX3:21CV:024246', 'alias' => 'IMPERA C', 'nombre' => 'IMPERA 3000']
                ]
            ],

            // MERKUR MAX (parent)
            [
                'identificador' => 'B:MA3:21 V:104098',
                'alias' => 'M-MAX',
                'nombre' => 'MERKUR MAX 3000',
                'local' => 'Muchamiel',
                'type' => 'parent',
                'children' => [
                    ['identificador' => 'B:MA3:21AV:104098', 'alias' => 'M-MAX A', 'nombre' => 'MERKUR MAX 3000'],
                    ['identificador' => 'B:MA3:21BV:104098', 'alias' => 'M-MAX B', 'nombre' => 'MERKUR MAX 3000'],
                    ['identificador' => 'B:MA3:21CV:104098', 'alias' => 'M-MAX C', 'nombre' => 'MERKUR MAX 3000']
                ]
            ],

            // LINK MASTER (parent)
            [
                'identificador' => 'B:LT3:24 V:000168',
                'alias' => 'LINK MASTER',
                'nombre' => 'LINK MASTER 3000',
                'local' => 'Muchamiel',
                'type' => 'parent',
                'children' => [
                    ['identificador' => 'B:LT3:24AV:000168', 'alias' => 'LINK MASTER A', 'nombre' => 'LINK MASTER 3000'],
                    ['identificador' => 'B:LT3:24BV:000168', 'alias' => 'LINK MASTER B', 'nombre' => 'LINK MASTER 3000'],
                    ['identificador' => 'B:LT3:24CV:000168', 'alias' => 'LINK MASTER C', 'nombre' => 'LINK MASTER 3000']
                ]
            ],

            // ZITRO (parent)
            [
                'identificador' => 'B:MK3:24 V:013349',
                'alias' => 'ZITRO',
                'nombre' => 'MULTILINK 1000',
                'local' => 'Muchamiel',
                'type' => 'parent',
                'children' => [
                    ['identificador' => 'B:MK3:24AV:013349', 'alias' => 'ZITRO A', 'nombre' => 'MULTILINK 1000'],
                    ['identificador' => 'B:MK3:24BV:013349', 'alias' => 'ZITRO B', 'nombre' => 'MULTILINK 1000'],
                    ['identificador' => 'B:MK3:24CV:013349', 'alias' => 'ZITRO C', 'nombre' => 'MULTILINK 1000']
                ]
            ],

            // FLORIDA /* actualizado 04/07/2025 */

            // Ruletas
            [
                'identificador' => 'B:RJ8:21 V:000050',
                'nombre' => 'RULETA COMATEL 1000',
                'alias' => 'RULETA',
                'local' => 'Florida',
                'type' => 'roulette', // Especificamos que es una ruleta
                'children' => [
                    ['identificador' => 'B:RJ8:211V:000050', 'nombre' => 'RULETA COMATEL 1000', 'alias' => 'RULETA PUESTO 1', 'local' => 'Florida'],
                    ['identificador' => 'B:RJ8:212V:000050', 'nombre' => 'RULETA COMATEL 1000', 'alias' => 'RULETA PUESTO 2', 'local' => 'Florida'],
                    ['identificador' => 'B:RJ8:213V:000050', 'nombre' => 'RULETA COMATEL 1000', 'alias' => 'RULETA PUESTO 3', 'local' => 'Florida'],
                    ['identificador' => 'B:RJ8:214V:000050', 'nombre' => 'RULETA COMATEL 1000', 'alias' => 'RULETA PUESTO 4', 'local' => 'Florida'],
                    ['identificador' => 'B:RJ8:215V:000050', 'nombre' => 'RULETA COMATEL 1000', 'alias' => 'RULETA PUESTO 5', 'local' => 'Florida'],
                    ['identificador' => 'B:RJ8:216V:000050', 'nombre' => 'RULETA COMATEL 1000', 'alias' => 'RULETA PUESTO 6', 'local' => 'Florida'],
                    ['identificador' => 'B:RJ8:217V:000050', 'nombre' => 'RULETA COMATEL 1000', 'alias' => 'RULETA PUESTO 7', 'local' => 'Florida'],
                    ['identificador' => 'B:RJ8:218V:000050', 'nombre' => 'RULETA COMATEL 1000', 'alias' => 'RULETA PUESTO 8', 'local' => 'Florida'],
                ],
            ],

            // Máquinas sin relaciones específicas
            ['identificador' => 'B:GJK:14 V:001773', 'alias' => 'GRANJA', 'nombre' => 'GRANJA 500', 'type' => 'single', 'local' => 'Florida'],
            ['identificador' => 'B:NEQ:15 V:008593', 'alias' => 'NEOPOLIS', 'nombre' => 'NEOPOLIS 500', 'type' => 'single', 'local' => 'Florida'],
            ['identificador' => 'B:DOQ:16 V:015874', 'alias' => 'DORADO', 'nombre' => 'EL DORADO 500', 'type' => 'single', 'local' => 'Florida'],
            ['identificador' => 'B:MMU:19 V:100352', 'alias' => 'MERKUR MULTI', 'nombre' => 'MERKUR MULTI', 'type' => 'single', 'local' => 'Florida'],
            ['identificador' => 'B:MBM:25 V:000034', 'alias' => 'MANHATTAN', 'nombre' => 'SALÓN BOOM DE MANHATTAN', 'type' => 'single', 'local' => 'Florida'],


            // MERKUR III (parent)
            [
                'identificador' => 'B:M33:16 V:001001',
                'alias' => 'MERKUR III',
                'nombre' => 'MERKUR III 600',
                'local' => 'Florida',
                'type' => 'parent',
                'children' => [
                    ['identificador' => 'B:M33:16AV:001001', 'alias' => 'MERKUR III A', 'nombre' => 'MERKUR III 600'],
                    ['identificador' => 'B:M33:16BV:001001', 'alias' => 'MERKUR III B', 'nombre' => 'MERKUR III 600'],
                    ['identificador' => 'B:M33:16CV:001001', 'alias' => 'MERKUR III C', 'nombre' => 'MERKUR III 600']
                ]
            ],

            // POWER LINK (parent)
            [
                'identificador' => 'B:PN3:20 V:021127',
                'alias' => 'POWER LINK',
                'nombre' => 'POWER LINK 1000',
                'local' => 'Florida',
                'type' => 'parent',
                'children' => [
                    ['identificador' => 'B:PN3:20AV:021127', 'alias' => 'POWER LINK A', 'nombre' => 'POWER LINK 1000'],
                    ['identificador' => 'B:PN3:20BV:021127', 'alias' => 'POWER LINK B', 'nombre' => 'POWER LINK 1000'],
                    ['identificador' => 'B:PN3:20CV:021127', 'alias' => 'POWER LINK C', 'nombre' => 'POWER LINK 1000']
                ]
            ],

            // IMPERA (parent)
            [
                'identificador' => 'B:IX3:21 V:025094',
                'alias' => 'IMPERA',
                'nombre' => 'IMPERA 3000',
                'local' => 'Florida',
                'type' => 'parent',
                'children' => [
                    ['identificador' => 'B:IX3:21AV:025094', 'alias' => 'IMPERA A', 'nombre' => 'IMPERA 3000'],
                    ['identificador' => 'B:IX3:21BV:025094', 'alias' => 'IMPERA B', 'nombre' => 'IMPERA 3000'],
                    ['identificador' => 'B:IX3:21CV:025094', 'alias' => 'IMPERA C', 'nombre' => 'IMPERA 3000']
                ]
            ],

            // MAGIC FORTUNE (parent)
            [
                'identificador' => 'B:MT3:22 V:000030',
                'alias' => 'MAGIC FORTUNE',
                'nombre' => 'MAGIC FORTUNE 3000',
                'local' => 'Florida',
                'type' => 'parent',
                'children' => [
                    ['identificador' => 'B:MT3:22AV:000030', 'alias' => 'FORTUNE A', 'nombre' => 'MAGIC FORTUNE 3000'],
                    ['identificador' => 'B:MT3:22BV:000030', 'alias' => 'FORTUNE B', 'nombre' => 'MAGIC FORTUNE 3000'],
                    ['identificador' => 'B:MT3:22CV:000030', 'alias' => 'FORTUNE C', 'nombre' => 'MAGIC FORTUNE 3000']
                ]
            ],

            // ZITRO (parent)
            [
                'identificador' => 'B:MK3:23 V:011936',
                'alias' => 'ZITRO',
                'nombre' => 'MULTILINK 1000',
                'local' => 'Florida',
                'type' => 'parent',
                'children' => [
                    ['identificador' => 'B:MK3:23AV:011936', 'alias' => 'ZITRO A', 'nombre' => 'MULTILINK 1000'],
                    ['identificador' => 'B:MK3:23BV:011936', 'alias' => 'ZITRO B', 'nombre' => 'MULTILINK 1000'],
                    ['identificador' => 'B:MK3:23CV:011936', 'alias' => 'ZITRO C', 'nombre' => 'MULTILINK 1000']
                ]
            ],

            // MERKUR LADY (parent)
            [
                'identificador' => 'B:LY3:25 V:110097',
                'alias' => 'M-LADY',
                'nombre' => 'MERKUR LADY 3000',
                'local' => 'Florida',
                'type' => 'parent',
                'children' => [
                    ['identificador' => 'B:LY3:25AV:110097', 'alias' => 'M-LADY A', 'nombre' => 'MERKUR LADY 3000'],
                    ['identificador' => 'B:LY3:25BV:110097', 'alias' => 'M-LADY B', 'nombre' => 'MERKUR LADY 3000'],
                    ['identificador' => 'B:LY3:25CV:110097', 'alias' => 'M-LADY C', 'nombre' => 'MERKUR LADY 3000']
                ]
            ],

            // PRIMO DE RIVERA /* actualizado 04/07/2025 */

            // Ruleta
            [
                'identificador' => 'B:RG8:18 V:000112',
                'nombre' => 'RULETA COMATEL 1000',
                'alias' => 'RULETA',
                'local' => 'Primo de Rivera',
                'type' => 'roulette', // Especificamos que es una ruleta
                'children' => [
                    ['identificador' => 'B:RG8:181V:000112', 'nombre' => 'RULETA COMATEL 1000', 'alias' => 'RULETA PUESTO 1', 'local' => 'Primo de Rivera'],
                    ['identificador' => 'B:RG8:182V:000112', 'nombre' => 'RULETA COMATEL 1000', 'alias' => 'RULETA PUESTO 2', 'local' => 'Primo de Rivera'],
                    ['identificador' => 'B:RG8:183V:000112', 'nombre' => 'RULETA COMATEL 1000', 'alias' => 'RULETA PUESTO 3', 'local' => 'Primo de Rivera'],
                    ['identificador' => 'B:RG8:184V:000112', 'nombre' => 'RULETA COMATEL 1000', 'alias' => 'RULETA PUESTO 4', 'local' => 'Primo de Rivera'],
                    ['identificador' => 'B:RG8:185V:000112', 'nombre' => 'RULETA COMATEL 1000', 'alias' => 'RULETA PUESTO 5', 'local' => 'Primo de Rivera'],
                    ['identificador' => 'B:RG8:186V:000112', 'nombre' => 'RULETA COMATEL 1000', 'alias' => 'RULETA PUESTO 6', 'local' => 'Primo de Rivera'],
                    ['identificador' => 'B:RG8:187V:000112', 'nombre' => 'RULETA COMATEL 1000', 'alias' => 'RULETA PUESTO 7', 'local' => 'Primo de Rivera'],
                    ['identificador' => 'B:RG8:188V:000112', 'nombre' => 'RULETA COMATEL 1000', 'alias' => 'RULETA PUESTO 8', 'local' => 'Primo de Rivera'],
                ],
            ],

            // Máquinas sin relaciones específicas
            ['identificador' => 'B:YEQ:15 V:000270', 'alias' => 'YETIMANIA', 'nombre' => 'YETIMANIA 500', 'type' => 'single', 'local' => 'Primo de Rivera'],
            ['identificador' => 'B:NEQ:15 V:008591', 'alias' => 'NEOPOLIS', 'nombre' => 'NEOPOLIS 500', 'type' => 'single', 'local' => 'Primo de Rivera'],
            ['identificador' => 'B:BLQ:16 V:016639', 'alias' => 'BURLESQUE', 'nombre' => 'BURLESQUE 500', 'type' => 'single', 'local' => 'Primo de Rivera'],
            ['identificador' => 'B:MMU:19 V:100358', 'alias' => 'MERKUR MULTI', 'nombre' => 'MERKUR MULTI 500', 'type' => 'single', 'local' => 'Primo de Rivera'],
            ['identificador' => 'B:REY:19 V:003331', 'alias' => 'REY DE LA SUERTE', 'nombre' => 'REY DE LA SUERTE 500', 'type' => 'single', 'local' => 'Primo de Rivera'],
            ['identificador' => 'B:PAM:24 V:000084', 'alias' => 'MANHATTAN', 'nombre' => 'MANHATTAN PARTY 1000', 'type' => 'single', 'local' => 'Primo de Rivera'],
            ['identificador' => 'B:WHQ:16 V:025798', 'alias' => 'WOONSTER', 'nombre' => 'WOONSTER HOTEL 500', 'type' => 'single', 'local' => 'Primo de Rivera'],


            // POWER LINK (parent)
            [
                'identificador' => 'B:PN3:20 V:021136',
                'alias' => 'POWER LINK',
                'nombre' => 'POWER LINK 1000',
                'local' => 'Primo de Rivera',
                'type' => 'parent',
                'children' => [
                    ['identificador' => 'B:PN3:20AV:021136', 'alias' => 'POWER LINK A', 'nombre' => 'POWER LINK 1000'],
                    ['identificador' => 'B:PN3:20BV:021136', 'alias' => 'POWER LINK B', 'nombre' => 'POWER LINK 1000'],
                    ['identificador' => 'B:PN3:20CV:021136', 'alias' => 'POWER LINK C', 'nombre' => 'POWER LINK 1000']
                ]
            ],

            // IMPERA (parent)
            [
                'identificador' => 'B:IX3:21 V:025093',
                'alias' => 'IMPERA',
                'nombre' => 'IMPERA 3000',
                'local' => 'Primo de Rivera',
                'type' => 'parent',
                'children' => [
                    ['identificador' => 'B:IX3:21AV:025093', 'alias' => 'IMPERA A', 'nombre' => 'IMPERA 3000'],
                    ['identificador' => 'B:IX3:21BV:025093', 'alias' => 'IMPERA B', 'nombre' => 'IMPERA 3000'],
                    ['identificador' => 'B:IX3:21CV:025093', 'alias' => 'IMPERA C', 'nombre' => 'IMPERA 3000']
                ]
            ],

            // LINK MASTER (parent)
            [
                'identificador' => 'B:BS3:23 V:107982',
                'alias' => 'LINK MASTER',
                'nombre' => 'LINK MASTER TRIPLE 3000',
                'local' => 'Primo de Rivera',
                'type' => 'parent',
                'children' => [
                    ['identificador' => 'B:BS3:23AV:107982', 'alias' => 'LINK MASTER A', 'nombre' => 'LINK MASTER TRIPLE 3000'],
                    ['identificador' => 'B:BS3:23BV:107982', 'alias' => 'LINK MASTER B', 'nombre' => 'LINK MASTER TRIPLE 3000'],
                    ['identificador' => 'B:BS3:23CV:107982', 'alias' => 'LINK MASTER C', 'nombre' => 'LINK MASTER TRIPLE 3000']
                ]
            ],


            // PEGO /* actualizado 04/07/2025 */

            // Ruleta
            [
                'identificador' => 'B:GX8:23 V:000092',
                'nombre' => 'RULETA INFINITY 3000',
                'alias' => 'RULETA',
                'local' => 'Pego',
                'type' => 'roulette', // Especificamos que es una ruleta
                'children' => [
                    ['identificador' => 'B:GX8:231V:000092', 'nombre' => 'RULETA INFINITY 3000', 'alias' => 'RULETA PUESTO 1', 'local' => 'Pego'],
                ],
            ],

            // Máquinas sin relaciones específicas
            ['identificador' => 'B:WOT:12 V:000200', 'alias' => 'WOONSTERS', 'nombre' => 'GIGAMES WOONSTERS 500', 'type' => 'single', 'local' => 'Pego'],
            ['identificador' => 'B:NEQ:16 V:003800', 'alias' => 'NEOPOLIS', 'nombre' => 'NEOPOLIS 500', 'type' => 'single', 'local' => 'Pego'],
            ['identificador' => 'B:GNS:14 V:000048', 'alias' => 'GNOMOS', 'nombre' => 'GNOMO MIX SALON 600', 'type' => 'single', 'local' => 'Pego'],

            // MERKUR III (parent)
            [
                'identificador' => 'B:M33:16 V:000905',
                'alias' => 'MERKUR III',
                'nombre' => 'MERKUR III 600',
                'local' => 'Pego',
                'type' => 'parent',
                'children' => [
                    ['identificador' => 'B:M33:16AV:000905', 'alias' => 'MERKUR III A', 'nombre' => 'MERKUR III 600'],
                    ['identificador' => 'B:M33:16BV:000905', 'alias' => 'MERKUR III B', 'nombre' => 'MERKUR III 600'],
                    ['identificador' => 'B:M33:16CV:000905', 'alias' => 'MERKUR III C', 'nombre' => 'MERKUR III 600']
                ]
            ],

            // GRAN LUX (parent)
            [
                'identificador' => 'B:LGT:19 V:002293',
                'alias' => 'GRAN LUX',
                'nombre' => 'GRAN LUX 1000',
                'local' => 'Pego',
                'type' => 'parent',
                'children' => [
                    ['identificador' => 'B:LGT:19AV:002293', 'alias' => 'GRAN LUX A', 'nombre' => 'GRAN LUX 1000'],
                    ['identificador' => 'B:LGT:19BV:002293', 'alias' => 'GRAN LUX B', 'nombre' => 'GRAN LUX 1000'],
                    ['identificador' => 'B:LGT:19CV:002293', 'alias' => 'GRAN LUX C', 'nombre' => 'GRAN LUX 1000']
                ]
            ],

            // ZITRO (parent)
            [
                'identificador' => 'B:MK3:19 V:003515',
                'alias' => 'ZITRO',
                'nombre' => 'MULTILINK 1000',
                'local' => 'Pego',
                'type' => 'parent',
                'children' => [
                    ['identificador' => 'B:MK3:19AV:003515', 'alias' => 'ZITRO A', 'nombre' => 'MULTILINK 1000'],
                    ['identificador' => 'B:MK3:19BV:003515', 'alias' => 'ZITRO B', 'nombre' => 'MULTILINK 1000'],
                    ['identificador' => 'B:MK3:19CV:003515', 'alias' => 'ZITRO C', 'nombre' => 'MULTILINK 1000']
                ]
            ],

            // POWER LINK (parent)
            [
                'identificador' => 'B:PT3:21 V:025248',
                'alias' => 'POWER LINK',
                'nombre' => 'POWER LINK 3000',
                'local' => 'Pego',
                'type' => 'parent',
                'children' => [
                    ['identificador' => 'B:PT3:21AV:025248', 'alias' => 'POWER LINK A', 'nombre' => 'POWER LINK 3000'],
                    ['identificador' => 'B:PT3:21BV:025248', 'alias' => 'POWER LINK B', 'nombre' => 'POWER LINK 3000'],
                    ['identificador' => 'B:PT3:21CV:025248', 'alias' => 'POWER LINK C', 'nombre' => 'POWER LINK 3000']
                ]
            ],

            // MYSTIC LINK (parent)
            [
                'identificador' => 'B:LI3:24 V:108660',
                'alias' => 'MYSTIC LINK',
                'nombre' => 'MERKUR MYSTIC LINK 3000',
                'local' => 'Pego',
                'type' => 'parent',
                'children' => [
                    ['identificador' => 'B:LI3:24AV:108660', 'alias' => 'MYSTIC LINK A', 'nombre' => 'MERKUR MYSTIC LINK 3000'],
                    ['identificador' => 'B:LI3:24BV:108660', 'alias' => 'MYSTIC LINK B', 'nombre' => 'MERKUR MYSTIC LINK 3000'],
                    ['identificador' => 'B:LI3:24CV:108660', 'alias' => 'MYSTIC LINK C', 'nombre' => 'MERKUR MYSTIC LINK 3000']
                ]
            ],

            // BENISA /* actualizado 04/07/2025 */

            // Ruleta
            [
                'identificador' => 'B:RX8:19 V:000136',
                'nombre' => 'RULETA COMATEL 3000',
                'alias' => 'RULETA', // Corregido el alias
                'local' => 'Benisa',
                'type' => 'roulette', // Especificamos que es una ruleta
                'children' => [
                    ['identificador' => 'B:RX8:191V:000136', 'nombre' => 'RULETA COMATEL 3000', 'alias' => 'RULETA PUESTO 1', 'local' => 'Benisa'],
                    ['identificador' => 'B:RX8:192V:000136', 'nombre' => 'RULETA COMATEL 3000', 'alias' => 'RULETA PUESTO 2', 'local' => 'Benisa'],
                    ['identificador' => 'B:RX8:193V:000136', 'nombre' => 'RULETA COMATEL 3000', 'alias' => 'RULETA PUESTO 3', 'local' => 'Benisa'],
                    ['identificador' => 'B:RX8:194V:000136', 'nombre' => 'RULETA COMATEL 3000', 'alias' => 'RULETA PUESTO 4', 'local' => 'Benisa'],
                    ['identificador' => 'B:RX8:195V:000136', 'nombre' => 'RULETA COMATEL 3000', 'alias' => 'RULETA PUESTO 5', 'local' => 'Benisa'],
                    ['identificador' => 'B:RX8:196V:000136', 'nombre' => 'RULETA COMATEL 3000', 'alias' => 'RULETA PUESTO 6', 'local' => 'Benisa'],
                    ['identificador' => 'B:RX8:197V:000136', 'nombre' => 'RULETA COMATEL 3000', 'alias' => 'RULETA PUESTO 7', 'local' => 'Benisa'],
                    ['identificador' => 'B:RX8:198V:000136', 'nombre' => 'RULETA COMATEL 3000', 'alias' => 'RULETA PUESTO 8', 'local' => 'Benisa'],
                ],
            ],

            // Máquinas sin relaciones específicas
            ['identificador' => 'B:DOQ:16 V:017672', 'nombre' => 'EL DORADO 500', 'alias' => 'DORADO', 'type' => 'single', 'local' => 'Benisa'],
            ['identificador' => 'B:CHM:18 V:002867', 'nombre' => 'CHIRINGUITO SALON 1000', 'alias' => 'CHIRINGUITO', 'type' => 'single', 'local' => 'Benisa'],
            ['identificador' => 'B:N3B:19 V:035955', 'nombre' => 'NOVOLINE BAR III 500', 'alias' => 'NOVOLINE', 'type' => 'single', 'local' => 'Benisa'],

            // ACTION STAR (parent)
            [
                'identificador' => 'B:AS3:17 V:000034',
                'nombre' => 'ACTION STAR 600',
                'alias' => 'ACTION STAR',
                'local' => 'Benisa',
                'type' => 'parent',
                'children' => [
                    ['identificador' => 'B:AS3:17AV:000034', 'nombre' => 'ACTION STAR 600', 'alias' => 'ACTION STAR A'],
                    ['identificador' => 'B:AS3:17BV:000034', 'nombre' => 'ACTION STAR 600', 'alias' => 'ACTION STAR B'],
                    ['identificador' => 'B:AS3:17CV:000034', 'nombre' => 'ACTION STAR 600', 'alias' => 'ACTION STAR C']
                ]
            ],

            // MAGIC FORTUNE (parent)
            [
                'identificador' => 'B:MT3:23 V:000001',
                'nombre' => 'MAGIC FORTUNE 3000',
                'alias' => 'FORTUNE',
                'local' => 'Benisa',
                'type' => 'parent',
                'children' => [
                    ['identificador' => 'B:MT3:23AV:000001', 'nombre' => 'MAGIC FORTUNE 3000', 'alias' => 'FORTUNE A'],
                    ['identificador' => 'B:MT3:23BV:000001', 'nombre' => 'MAGIC FORTUNE 3000', 'alias' => 'FORTUNE B'],
                    ['identificador' => 'B:MT3:23CV:000001', 'nombre' => 'MAGIC FORTUNE 3000', 'alias' => 'FORTUNE C']
                ]
            ],

            // LINK MASTER (parent)
            [
                'identificador' => 'B:LT3:23 V:001148',
                'nombre' => 'LINK MASTER 3000',
                'alias' => 'LINK MASTER',
                'local' => 'Benisa',
                'type' => 'parent',
                'children' => [
                    ['identificador' => 'B:LT3:23AV:001148', 'nombre' => 'LINK MASTER 3000', 'alias' => 'LINK MASTER A'],
                    ['identificador' => 'B:LT3:23BV:001148', 'nombre' => 'LINK MASTER 3000', 'alias' => 'LINK MASTER B'],
                    ['identificador' => 'B:LT3:23CV:001148', 'nombre' => 'LINK MASTER 3000', 'alias' => 'LINK MASTER C']
                ]
            ],

            // ISLA ROCKET (parent)
            [
                'identificador' => 'B:RK3:24 V:001132',
                'nombre' => 'ISLA ROCKET 3000',
                'alias' => 'ROCKET',
                'local' => 'Benisa',
                'type' => 'parent',
                'children' => [
                    ['identificador' => 'B:RK3:24AV:001132', 'nombre' => 'ISLA ROCKET 3000', 'alias' => 'ROCKET A'],
                    ['identificador' => 'B:RK3:24BV:001132', 'nombre' => 'ISLA ROCKET 3000', 'alias' => 'ROCKET B'],
                    ['identificador' => 'B:RK3:24CV:001132', 'nombre' => 'ISLA ROCKET 3000', 'alias' => 'ROCKET C']
                ]
            ],


            // LA NUCIA /* actualizado 04/07/2025 */

            // Ruleta
            [
                'identificador' => 'B:RG8:18 V:000129',
                'nombre' => 'RULETA COMATEL 1000',
                'alias' => 'RULETA', // Corregido el alias
                'local' => 'La Nucia',
                'type' => 'roulette', // Especificamos que es una ruleta
                'children' => [
                    ['identificador' => 'B:RG8:181V:000129', 'nombre' => 'RULETA COMATEL 1000', 'alias' => 'RULETA PUESTO 1', 'local' => 'La Nucia'],
                    ['identificador' => 'B:RG8:182V:000129', 'nombre' => 'RULETA COMATEL 1000', 'alias' => 'RULETA PUESTO 2', 'local' => 'La Nucia'],
                    ['identificador' => 'B:RG8:183V:000129', 'nombre' => 'RULETA COMATEL 1000', 'alias' => 'RULETA PUESTO 3', 'local' => 'La Nucia'],
                    ['identificador' => 'B:RG8:184V:000129', 'nombre' => 'RULETA COMATEL 1000', 'alias' => 'RULETA PUESTO 4', 'local' => 'La Nucia'],
                    ['identificador' => 'B:RG8:185V:000129', 'nombre' => 'RULETA COMATEL 1000', 'alias' => 'RULETA PUESTO 5', 'local' => 'La Nucia'],
                    ['identificador' => 'B:RG8:186V:000129', 'nombre' => 'RULETA COMATEL 1000', 'alias' => 'RULETA PUESTO 6', 'local' => 'La Nucia'],
                    ['identificador' => 'B:RG8:187V:000129', 'nombre' => 'RULETA COMATEL 1000', 'alias' => 'RULETA PUESTO 7', 'local' => 'La Nucia'],
                    ['identificador' => 'B:RG8:188V:000129', 'nombre' => 'RULETA COMATEL 1000', 'alias' => 'RULETA PUESTO 8', 'local' => 'La Nucia'],
                ],
            ],

            // Máquinas sin relaciones específicas
            ['identificador' => 'B:DOQ:16 V:016644', 'nombre' => 'EL DORADO 500', 'alias' => 'DORADO', 'type' => 'single', 'local' => 'La Nucia'],
            ['identificador' => 'B:REY:19 V:003336', 'nombre' => 'REY DE LA SUERTE 500', 'alias' => 'REY DE LA SUERTE', 'type' => 'single', 'local' => 'La Nucia'],

            // ZUUM OPERA (parent)
            [
                'identificador' => 'B:OP2:23 V:000008',
                'nombre' => 'ZUUM OPERA 1000',
                'alias' => 'ZUUM',
                'local' => 'La Nucia',
                'type' => 'parent',
                'children' => [
                    ['identificador' => 'B:OP2:23AV:000008', 'nombre' => 'ZUUM OPERA 1000', 'alias' => 'OPERA A'],
                    ['identificador' => 'B:OP2:23BV:000008', 'nombre' => 'ZUUM OPERA 1000', 'alias' => 'OPERA B']
                ]
            ],

            // IMPERA LINK (parent)
            [
                'identificador' => 'B:IX3:21 V:023305',
                'nombre' => 'IMPERA LINK 3000',
                'alias' => 'IMPERA',
                'local' => 'La Nucia',
                'type' => 'parent',
                'children' => [
                    ['identificador' => 'B:IX3:21AV:023305', 'nombre' => 'IMPERA LINK 3000', 'alias' => 'IMPERA A'],
                    ['identificador' => 'B:IX3:21BV:023305', 'nombre' => 'IMPERA LINK 3000', 'alias' => 'IMPERA B'],
                    ['identificador' => 'B:IX3:21CV:023305', 'nombre' => 'IMPERA LINK 3000', 'alias' => 'IMPERA C']
                ]
            ],

            // POWER LINK (parent)
            [
                'identificador' => 'B:PT3:21 V:025245',
                'nombre' => 'POWER LINK 3000',
                'alias' => 'POWER LINK',
                'local' => 'La Nucia',
                'type' => 'parent',
                'children' => [
                    ['identificador' => 'B:PT3:21AV:025245', 'nombre' => 'POWER LINK 3000', 'alias' => 'POWER LINK A'],
                    ['identificador' => 'B:PT3:21BV:025245', 'nombre' => 'POWER LINK 3000', 'alias' => 'POWER LINK B'],
                    ['identificador' => 'B:PT3:21CV:025245', 'nombre' => 'POWER LINK 3000', 'alias' => 'POWER LINK C']
                ]
            ],

            // ACTION STAR (parent)
            [
                'identificador' => 'B:AK3:21 V:000073',
                'alias' => 'ACTION STAR',
                'nombre' => 'ACTION STAR 2 3000',
                'local' => 'La Nucia',
                'type' => 'parent',
                'children' => [
                    ['identificador' => 'B:AK3:21AV:000073', 'alias' => 'ACTION STAR A', 'nombre' => 'ACTION STAR 2 3000'],
                    ['identificador' => 'B:AK3:21BV:000073', 'alias' => 'ACTION STAR B', 'nombre' => 'ACTION STAR 2 3000'],
                    ['identificador' => 'B:AK3:21CV:000073', 'alias' => 'ACTION STAR C', 'nombre' => 'ACTION STAR 2 3000']
                ]
            ],

            // M-BOX (parent)
            [
                'identificador' => 'B:MB3:18 V:001838',
                'nombre' => 'M-BOX 600',
                'alias' => 'M-BOX',
                'local' => 'La Nucia',
                'type' => 'parent',
                'children' => [
                    ['identificador' => 'B:MB3:18AV:001838', 'nombre' => 'M-BOX 600', 'alias' => 'M-BOX A'],
                    ['identificador' => 'B:MB3:18BV:001838', 'nombre' => 'M-BOX 600', 'alias' => 'M-BOX B'],
                    ['identificador' => 'B:MB3:18CV:001838', 'nombre' => 'M-BOX 600', 'alias' => 'M-BOX C']
                ]
            ],

            // APOLO (parent)
            [
                'identificador' => 'B:AP3:25 V:000008',
                'nombre' => 'APOLO TRIPLE',
                'alias' => 'APOLO',
                'local' => 'La Nucia',
                'type' => 'parent',
                'children' => [
                    ['identificador' => 'B:AP3:25AV:000008', 'nombre' => 'APOLO TRIPLE', 'alias' => 'APOLO A'],
                    ['identificador' => 'B:AP3:25BV:000008', 'nombre' => 'APOLO TRIPLE', 'alias' => 'APOLO B'],
                    ['identificador' => 'B:AP3:25CV:000008', 'nombre' => 'APOLO TRIPLE', 'alias' => 'APOLO C']
                ]
            ],


            // GATA DE GORGOS /* actualizado 04/07/2025 */

            // Ruleta
            [
                'identificador' => 'B:GX8:23 V:000088',
                'nombre' => 'RULETA INFINITY 3000',
                'alias' => 'RULETA',
                'local' => 'Gata de Gorgos',
                'type' => 'roulette', // Especificamos que es una ruleta
                'children' => [
                    ['identificador' => 'B:GX8:231V:000088', 'nombre' => 'RULETA INFINITY 3000', 'alias' => 'RULETA PUESTO 1', 'local' => 'Gata de Gorgos'],
                ],
            ],



            // Máquinas sin relaciones específicas
            ['identificador' => 'B:GNQ:14 V:007845', 'nombre' => 'GNOMOS MIX 500', 'alias' => 'GNOMOS', 'type' => 'single', 'local' => 'Gata de Gorgos'],
            ['identificador' => 'B:MTQ:16 V:000768', 'nombre' => 'MAQUINA DEL TIEMPO 500', 'alias' => 'MAQUINA DEL TIEMPO', 'type' => 'single', 'local' => 'Gata de Gorgos'],
            ['identificador' => 'B:GJK:14 V:001781', 'nombre' => 'GRANJA 500', 'alias' => 'GRANJA', 'type' => 'single', 'local' => 'Gata de Gorgos'],
            ['identificador' => 'B:SFL:07 V:003824', 'nombre' => 'SANTA FE LOTO TRIPLE 240', 'alias' => 'SANTA FE', 'type' => 'single', 'local' => 'Gata de Gorgos'],

            // MERKUR III (parent)
            [
                'identificador' => 'B:M33:16 V:000911',
                'nombre' => 'MERKUR III 600',
                'alias' => 'MERKUR III',
                'local' => 'Gata de Gorgos',
                'type' => 'parent',
                'children' => [
                    ['identificador' => 'B:M33:16AV:000911', 'nombre' => 'MERKUR III 600', 'alias' => 'MERKUR III A'],
                    ['identificador' => 'B:M33:16BV:000911', 'nombre' => 'MERKUR III 600', 'alias' => 'MERKUR III B'],
                    ['identificador' => 'B:M33:16CV:000911', 'nombre' => 'MERKUR III 600', 'alias' => 'MERKUR III C']
                ]
            ],

            // M-BOX (parent)
            [
                'identificador' => 'B:MB3:18 V:003157',
                'nombre' => 'M-BOX 600',
                'alias' => 'M-BOX',
                'local' => 'Gata de Gorgos',
                'type' => 'parent',
                'children' => [
                    ['identificador' => 'B:MB3:18AV:003157', 'nombre' => 'M-BOX 600', 'alias' => 'M-BOX A'],
                    ['identificador' => 'B:MB3:18BV:003157', 'nombre' => 'M-BOX 600', 'alias' => 'M-BOX B'],
                    ['identificador' => 'B:MB3:18CV:003157', 'nombre' => 'M-BOX 600', 'alias' => 'M-BOX C']
                ]
            ],

            // POWER LINK (parent)
            [
                'identificador' => 'B:PN3:20 V:021137',
                'nombre' => 'POWER LINK 600',
                'alias' => 'POWER LINK',
                'local' => 'Gata de Gorgos',
                'type' => 'parent',
                'children' => [
                    ['identificador' => 'B:PN3:20AV:021137', 'nombre' => 'POWER LINK 600', 'alias' => 'POWER LINK A'],
                    ['identificador' => 'B:PN3:20BV:021137', 'nombre' => 'POWER LINK 600', 'alias' => 'POWER LINK B'],
                    ['identificador' => 'B:PN3:20CV:021137', 'nombre' => 'POWER LINK 600', 'alias' => 'POWER LINK C']
                ]
            ],

            // IMPERA LINK (parent)
            [
                'identificador' => 'B:IX3:21 V:024243',
                'nombre' => 'IMPERA LINK 3000',
                'alias' => 'IMPERA',
                'local' => 'Gata de Gorgos',
                'type' => 'parent',
                'children' => [
                    ['identificador' => 'B:IX3:21AV:024243', 'nombre' => 'IMPERA LINK 3000', 'alias' => 'IMPERA A'],
                    ['identificador' => 'B:IX3:21BV:024243', 'nombre' => 'IMPERA LINK 3000', 'alias' => 'IMPERA B'],
                    ['identificador' => 'B:IX3:21CV:024243', 'nombre' => 'IMPERA LINK 3000', 'alias' => 'IMPERA C']
                ]
            ],

            // TEULADA /* actualizado 04/07/2025 */

            // Ruleta
            [
                'identificador' => 'B:GX8:23 V:000094',
                'nombre' => 'RULETA INFINITY 3000',
                'alias' => 'RULETA',
                'local' => 'Teulada',
                'type' => 'roulette', // Especificamos que es una ruleta
                'children' => [
                    ['identificador' => 'B:GX8:231V:000094', 'nombre' => 'RULETA INFINITY 3000', 'alias' => 'RULETA PUESTO 1', 'local' => 'Teulada'],
                ],
            ],

            // Sin relaciones (máquinas que no tienen hijos)
            ['identificador' => 'B:N3B:19 V:035958', 'nombre' => 'NOVOLINE III BAR 500', 'alias' => 'NOVOLINE III', 'type' => 'single', 'local' => 'Teulada'],
            ['identificador' => 'B:AB1:19 V:001677', 'nombre' => 'ACTION STAR BAR 500', 'alias' => 'ACTION STAR BAR', 'type' => 'single', 'local' => 'Teulada'],

            [
                'identificador' => 'B:MB3:20 V:102746',
                'nombre' => 'M-BOX 600',
                'alias' => 'M-BOX',
                'local' => 'Teulada',
                'type' => 'parent',
                'children' => [
                    ['identificador' => 'B:MB3:20AV:102746', 'nombre' => 'M-BOX 600', 'alias' => 'M-BOX A'],
                    ['identificador' => 'B:MB3:20BV:102746', 'nombre' => 'M-BOX 600', 'alias' => 'M-BOX B'],
                    ['identificador' => 'B:MB3:20CV:102746', 'nombre' => 'M-BOX 600', 'alias' => 'M-BOX C']
                ]
            ],

            [
                'identificador' => 'B:IX3:21 V:025095',
                'nombre' => 'IMPERA LINK 3000',
                'alias' => 'IMPERA',
                'local' => 'Teulada',
                'type' => 'parent',
                'children' => [
                    ['identificador' => 'B:IX3:21AV:025095', 'nombre' => 'IMPERA LINK 3000', 'alias' => 'IMPERA A'],
                    ['identificador' => 'B:IX3:21BV:025095', 'nombre' => 'IMPERA LINK 3000', 'alias' => 'IMPERA B'],
                    ['identificador' => 'B:IX3:21CV:025095', 'nombre' => 'IMPERA LINK 3000', 'alias' => 'IMPERA C']
                ]
            ],

            [
                'identificador' => 'B:PT3:22 V:026079',
                'nombre' => 'POWER LINK 3000',
                'alias' => 'POWER LINK',
                'local' => 'Teulada',
                'type' => 'parent',
                'children' => [
                    ['identificador' => 'B:PT3:22AV:026079', 'nombre' => 'POWER LINK 3000', 'alias' => 'POWER LINK A'],
                    ['identificador' => 'B:PT3:22BV:026079', 'nombre' => 'POWER LINK 3000', 'alias' => 'POWER LINK B'],
                    ['identificador' => 'B:PT3:22CV:026079', 'nombre' => 'POWER LINK 3000', 'alias' => 'POWER LINK C']
                ]
            ],

            [
                'identificador' => 'B:IX3:23 V:030990',
                'nombre' => 'IMPERA LINK 3000',
                'alias' => 'IMPERA',
                'local' => 'Teulada',
                'type' => 'parent',
                'children' => [
                    ['identificador' => 'B:IX3:23AV:030990', 'nombre' => 'IMPERA LINK 3000', 'alias' => 'IMPERA D'],
                    ['identificador' => 'B:IX3:23BV:030990', 'nombre' => 'IMPERA LINK 3000', 'alias' => 'IMPERA E'],
                    ['identificador' => 'B:IX3:23CV:030990', 'nombre' => 'IMPERA LINK 3000', 'alias' => 'IMPERA F']
                ]
            ],

            [
                'identificador' => 'B:AS3:17 V:000032',
                'nombre' => 'ACTION STAR 600',
                'alias' => 'ACTION STAR',
                'local' => 'Teulada',
                'type' => 'parent',
                'children' => [
                    ['identificador' => 'B:AS3:17AV:000032', 'nombre' => 'ACTION STAR 600', 'alias' => 'ACTION STAR A'],
                    ['identificador' => 'B:AS3:17BV:000032', 'nombre' => 'ACTION STAR 600', 'alias' => 'ACTION STAR B'],
                    ['identificador' => 'B:AS3:17CV:000032', 'nombre' => 'ACTION STAR 600', 'alias' => 'ACTION STAR C']
                ]
            ],

            // ZITRO (parent)
            [
                'identificador' => 'B:MK3:24 V:015088',
                'alias' => 'ZITRO',
                'nombre' => 'MULTILINK 1000',
                'local' => 'Teulada',
                'type' => 'parent',
                'children' => [
                    ['identificador' => 'B:MK3:24AV:015088', 'alias' => 'ZITRO A', 'nombre' => 'MULTILINK 1000'],
                    ['identificador' => 'B:MK3:24BV:015088', 'alias' => 'ZITRO B', 'nombre' => 'MULTILINK 1000'],
                    ['identificador' => 'B:MK3:24CV:015088', 'alias' => 'ZITRO C', 'nombre' => 'MULTILINK 1000']
                ]
            ],

            // MERKUR LADY (parent)
            [
                'identificador' => 'B:LY3:25 V:110099',
                'alias' => 'M-LADY',
                'nombre' => 'MERKUR LADY 3000',
                'local' => 'Teulada',
                'type' => 'parent',
                'children' => [
                    ['identificador' => 'B:LY3:25AV:110099', 'alias' => 'M-LADY A', 'nombre' => 'MERKUR LADY 3000'],
                    ['identificador' => 'B:LY3:25BV:110099', 'alias' => 'M-LADY B', 'nombre' => 'MERKUR LADY 3000'],
                    ['identificador' => 'B:LY3:25CV:110099', 'alias' => 'M-LADY C', 'nombre' => 'MERKUR LADY 3000']
                ]
            ],


            // CALPE /* actualizado 04/07/2025 */

            // Ruleta
            [
                'identificador' => 'B:GC8:23 V:000131',
                'nombre' => 'RULETA INFINITY 3000',
                'alias' => 'RULETA',
                'local' => 'Calpe',
                'type' => 'roulette', // Especificamos que es una ruleta
                'children' => [
                    ['identificador' => 'B:GC8:231V:000131', 'nombre' => 'RULETA INFINITY 3000', 'alias' => 'RULETA PUESTO 1', 'local' => 'Calpe'],
                ],
            ],



            // Sin relaciones (máquinas que no tienen hijos)
            ['identificador' => 'B:N3B:19 V:035947', 'nombre' => 'NOVOLINE III BAR 500', 'alias' => 'NOVOLINE III', 'type' => 'single', 'local' => 'Calpe'],
            ['identificador' => 'B:FGQ:14 V:003524', 'nombre' => 'FUEGO PLUS 500', 'alias' => 'FUEGO', 'type' => 'single', 'local' => 'Calpe'],

            // Con relaciones (padres e hijos)
            [
                'identificador' => 'B:PN6:21 V:023584',
                'nombre' => 'POWER LINK 3000',
                'alias' => 'POWER LINK',
                'local' => 'Calpe',
                'type' => 'parent',
                'children' => [
                    ['identificador' => 'B:PN6:21AV:023584', 'nombre' => 'POWER LINK 3000', 'alias' => 'POWER LINK A'],
                    ['identificador' => 'B:PN6:21BV:023584', 'nombre' => 'POWER LINK 3000', 'alias' => 'POWER LINK B'],
                    ['identificador' => 'B:PN6:21CV:023584', 'nombre' => 'POWER LINK 3000', 'alias' => 'POWER LINK C'],
                    ['identificador' => 'B:PN6:21DV:023584', 'nombre' => 'POWER LINK 3000', 'alias' => 'POWER LINK D'],
                    ['identificador' => 'B:PN6:21EV:023584', 'nombre' => 'POWER LINK 3000', 'alias' => 'POWER LINK E'],
                    ['identificador' => 'B:PN6:21FV:023584', 'nombre' => 'POWER LINK 3000', 'alias' => 'POWER LINK F']
                ]
            ],

            [
                'identificador' => 'B:IX3:21 V:023934',
                'nombre' => 'IMPERA LINK 3000',
                'alias' => 'IMPERA',
                'local' => 'Calpe',
                'type' => 'parent',
                'children' => [
                    ['identificador' => 'B:IX3:21AV:023934', 'nombre' => 'IMPERA LINK 3000', 'alias' => 'IMPERA A'],
                    ['identificador' => 'B:IX3:21BV:023934', 'nombre' => 'IMPERA LINK 3000', 'alias' => 'IMPERA B'],
                    ['identificador' => 'B:IX3:21CV:023934', 'nombre' => 'IMPERA LINK 3000', 'alias' => 'IMPERA C']
                ]
            ],

            [
                'identificador' => 'B:MA3:21 V:104191',
                'nombre' => 'MERKUR MAX 3000',
                'alias' => 'M-MAX',
                'local' => 'Calpe',
                'type' => 'parent',
                'children' => [
                    ['identificador' => 'B:MA3:21AV:104191', 'nombre' => 'MERKUR MAX 3000', 'alias' => 'M-MAX A'],
                    ['identificador' => 'B:MA3:21BV:104191', 'nombre' => 'MERKUR MAX 3000', 'alias' => 'M-MAX B'],
                    ['identificador' => 'B:MA3:21CV:104191', 'nombre' => 'MERKUR MAX 3000', 'alias' => 'M-MAX C']
                ]
            ],

            [
                'identificador' => 'B:PT3:21 V:025246',
                'nombre' => 'POWER LINK 3000',
                'alias' => 'POWER LINK',
                'local' => 'Calpe',
                'type' => 'parent',
                'children' => [
                    ['identificador' => 'B:PT3:21AV:025246', 'nombre' => 'POWER LINK 3000', 'alias' => 'POWER LINK 19'],
                    ['identificador' => 'B:PT3:21BV:025246', 'nombre' => 'POWER LINK 3000', 'alias' => 'POWER LINK 20'],
                    ['identificador' => 'B:PT3:21CV:025246', 'nombre' => 'POWER LINK 3000', 'alias' => 'POWER LINK 21']
                ]
            ],

            [
                'identificador' => 'B:LT3:23 V:001149',
                'nombre' => 'LINK MASTER 3000',
                'alias' => 'LINK MASTER',
                'local' => 'Calpe',
                'type' => 'parent',
                'children' => [
                    ['identificador' => 'B:LT3:23AV:001149', 'nombre' => 'LINK MASTER 3000', 'alias' => 'LINK MASTER A'],
                    ['identificador' => 'B:LT3:23BV:001149', 'nombre' => 'LINK MASTER 3000', 'alias' => 'LINK MASTER B'],
                    ['identificador' => 'B:LT3:23CV:001149', 'nombre' => 'LINK MASTER 3000', 'alias' => 'LINK MASTER C']
                ]
            ],


            // VERGEL /* actualizado 04/07/2025 */

            // Ruleta
            [
                'identificador' => 'B:RG8:20 V:000043',
                'nombre' => 'RULETA COMATEL 1000',
                'alias' => 'RULETA', // Alias corregido
                'local' => 'Vergel',
                'type' => 'roulette', // Especificamos que es una ruleta
                'children' => [
                    ['identificador' => 'B:RG8:201V:000043', 'nombre' => 'RULETA COMATEL 1000', 'alias' => 'RULETA PUESTO 1', 'local' => 'Vergel'],
                    ['identificador' => 'B:RG8:202V:000043', 'nombre' => 'RULETA COMATEL 1000', 'alias' => 'RULETA PUESTO 2', 'local' => 'Vergel'],
                    ['identificador' => 'B:RG8:203V:000043', 'nombre' => 'RULETA COMATEL 1000', 'alias' => 'RULETA PUESTO 3', 'local' => 'Vergel'],
                    ['identificador' => 'B:RG8:204V:000043', 'nombre' => 'RULETA COMATEL 1000', 'alias' => 'RULETA PUESTO 4', 'local' => 'Vergel'],
                    ['identificador' => 'B:RG8:205V:000043', 'nombre' => 'RULETA COMATEL 1000', 'alias' => 'RULETA PUESTO 5', 'local' => 'Vergel'],
                    ['identificador' => 'B:RG8:206V:000043', 'nombre' => 'RULETA COMATEL 1000', 'alias' => 'RULETA PUESTO 6', 'local' => 'Vergel'],
                    ['identificador' => 'B:RG8:207V:000043', 'nombre' => 'RULETA COMATEL 1000', 'alias' => 'RULETA PUESTO 7', 'local' => 'Vergel'],
                    ['identificador' => 'B:RG8:208V:000043', 'nombre' => 'RULETA COMATEL 1000', 'alias' => 'RULETA PUESTO 8', 'local' => 'Vergel'],
                ],
            ],

            // Sin relación (sin hijos)
            ['identificador' => 'B:N3B:19 V:035961', 'nombre' => 'NOVOLINE III BAR 500', 'alias' => 'NOVOLINE III', 'type' => 'single', 'local' => 'Vergel'],
            ['identificador' => 'B:VEQ:19 V:016036', 'nombre' => 'GIGAMES VENECIA MIX 500', 'alias' => 'VENECIA', 'type' => 'single', 'local' => 'Vergel'],

            // Máquinas con relación (Padre con hijos)

            // ACTION STAR 600 (padre e hijos)
            [
                'identificador' => 'B:AS3:18 V:000044',
                'nombre' => 'ACTION STAR 600',
                'alias' => 'ACTION STAR',
                'local' => 'Vergel',
                'type' => 'parent',
                'children' => [
                    ['identificador' => 'B:AS3:18AV:000044', 'nombre' => 'ACTION STAR 600', 'alias' => 'ACTION STAR A'],
                    ['identificador' => 'B:AS3:18BV:000044', 'nombre' => 'ACTION STAR 600', 'alias' => 'ACTION STAR B'],
                    ['identificador' => 'B:AS3:18CV:000044', 'nombre' => 'ACTION STAR 600', 'alias' => 'ACTION STAR C']
                ]
            ],

            [
                'identificador' => 'B:LT3:25 V:000368',
                'alias' => 'LINK MASTER',
                'nombre' => 'LINK MASTER 3000', ///////////////////// ESTOY HAY QUE MIRARLO SON LAS ROYALLLLLLLLL
                'local' => 'Vergel',
                'type' => 'parent',
                'children' => [
                    ['identificador' => 'B:LT3:25AV:000368', 'alias' => 'LINK MASTER A', 'nombre' => 'LINK MASTER 3000', 'local' => 'Javea'],
                    ['identificador' => 'B:LT3:25BV:000368', 'alias' => 'LINK MASTER B', 'nombre' => 'LINK MASTER 3000', 'local' => 'Javea'],
                    ['identificador' => 'B:LT3:25CV:000368', 'alias' => 'LINK MASTER C', 'nombre' => 'LINK MASTER 3000', 'local' => 'Javea']
                ]
            ],

            // M-BOX 600
            [
                'identificador' => 'B:MB3:19 V:100815',
                'nombre' => 'M-BOX 600',
                'alias' => 'M-BOX',
                'local' => 'Vergel',
                'type' => 'parent',
                'children' => [
                    ['identificador' => 'B:MB3:19AV:100815', 'nombre' => 'M-BOX 600', 'alias' => 'M-BOX A'],
                    ['identificador' => 'B:MB3:19BV:100815', 'nombre' => 'M-BOX 600', 'alias' => 'M-BOX B'],
                    ['identificador' => 'B:MB3:19CV:100815', 'nombre' => 'M-BOX 600', 'alias' => 'M-BOX C']
                ]
            ],

            // IMPERA LINK 3000 (padre e hijos)
            [
                'identificador' => 'B:IX3:21 V:025096',
                'nombre' => 'IMPERA LINK 3000',
                'alias' => 'IMPERA',
                'local' => 'Vergel',
                'type' => 'parent',
                'children' => [
                    ['identificador' => 'B:IX3:21AV:025096', 'nombre' => 'IMPERA LINK 3000', 'alias' => 'IMPERA A'],
                    ['identificador' => 'B:IX3:21BV:025096', 'nombre' => 'IMPERA LINK 3000', 'alias' => 'IMPERA B'],
                    ['identificador' => 'B:IX3:21CV:025096', 'nombre' => 'IMPERA LINK 3000', 'alias' => 'IMPERA C']
                ]
            ],

            // POWER LINK 3000 (padre e hijos)
            [
                'identificador' => 'B:PT3:21 V:025247',
                'nombre' => 'POWER LINK 3000',
                'alias' => 'POWER LINK',
                'local' => 'Vergel',
                'type' => 'parent',
                'children' => [
                    ['identificador' => 'B:PT3:21AV:025247', 'nombre' => 'POWER LINK 3000', 'alias' => 'POWER LINK A'],
                    ['identificador' => 'B:PT3:21BV:025247', 'nombre' => 'POWER LINK 3000', 'alias' => 'POWER LINK B'],
                    ['identificador' => 'B:PT3:21CV:025247', 'nombre' => 'POWER LINK 3000', 'alias' => 'POWER LINK C']
                ]
            ],

            // LINK MIX 3000 (padre e hijos)
            [
                'identificador' => 'B:HL3:23 V:000023',
                'nombre' => 'HIT THE LINK 3000',
                'alias' => 'HIT THE LINK',
                'local' => 'Vergel',
                'type' => 'parent',
                'children' => [
                    ['identificador' => 'B:HL3:23AV:000023', 'nombre' => 'HIT THE LINK 3000', 'alias' => 'HIT THE LINK A'],
                    ['identificador' => 'B:HL3:23BV:000023', 'nombre' => 'HIT THE LINK 3000', 'alias' => 'HIT THE LINK B'],
                    ['identificador' => 'B:HL3:23CV:000023', 'nombre' => 'HIT THE LINK 3000', 'alias' => 'HIT THE LINK C']
                ]
            ],

            // MULTILINK 1000 (padre e hijos)
            [
                'identificador' => 'B:MK3:23 V:011934',
                'nombre' => 'MULTILINK 1000',
                'alias' => 'ZITRO',
                'local' => 'Vergel',
                'type' => 'parent',
                'children' => [
                    ['identificador' => 'B:MK3:23AV:011934', 'nombre' => 'MULTILINK 1000', 'alias' => 'ZITRO A'],
                    ['identificador' => 'B:MK3:23BV:011934', 'nombre' => 'MULTILINK 1000', 'alias' => 'ZITRO B'],
                    ['identificador' => 'B:MK3:23CV:011934', 'nombre' => 'MULTILINK 1000', 'alias' => 'ZITRO C']
                ]
            ]

        ];

        foreach ($maquinasSalones as $maquinaData) {
            // Obtener el local
            $local = Local::where('name', $maquinaData['local'])->first();

            // Crear la máquina principal (padre o ruleta)
            $maquina = Machine::create([
                'identificador' => $maquinaData['identificador'],
                'name' => $maquinaData['nombre'],
                'alias' => $maquinaData['alias'],
                'local_id' => $local->id,
                'type' => $maquinaData['type'] ?? null, // Solo asignar type si está definido (padre o ruleta)
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            // Si es una máquina de tipo 'parent' o 'roulette', asignar los hijos
            if (isset($maquinaData['children'])) {
                foreach ($maquinaData['children'] as $childData) {
                    // Crear el hijo sin el campo 'type' (solo asignar 'parent_id')
                    $child = new Machine([
                        'identificador' => $childData['identificador'],
                        'name' => $childData['nombre'],
                        'alias' => $childData['alias'],
                        'local_id' => $local->id,
                        'parent_id' => $maquina->id, // Relacionar como hijo de la máquina principal
                        'created_at' => now(),
                        'updated_at' => now(),
                    ]);

                    // Guardar el hijo
                    $child->save();
                }
            }
        }


        $maquinasBares = [
            ['identificador' => 'B:PAQ:24 V:000843', 'type' => 'single', 'alias' => 'MANHATTAN', 'nombre' => 'MANHATTAN PARTY 500', 'bar' => 'Amanecer'], // CONFIRMADA
            ['identificador' => 'B:DOQ:16 V:017679', 'type' => 'single', 'alias' => 'DORADO', 'nombre' => 'DORADO 500', 'bar' => 'Casa Llauis'], // CONFIRMADA
            ['identificador' => 'B:SAQ:21 V:064266', 'type' => 'single', 'alias' => 'SAMARKANDA', 'nombre' => 'SAMARKANDA 500', 'bar' => 'Casa Llauis'], // CONFIRMADA
            ['identificador' => 'B:MHR:22 V:000392', 'type' => 'single', 'alias' => 'MANHATTAN', 'nombre' => 'MANHATTAN REVOLUTION 500', 'bar' => 'Havanna'], // CONFIRMADA
            ['identificador' => 'B:MSB:24 V:108501', 'type' => 'single', 'alias' => 'MERKUR SELECTION', 'nombre' => 'MERKUR SELECTION 500', 'bar' => 'Havanna'], // CONFIRMADA
            ['identificador' => 'B:MHR:22 V:001422', 'type' => 'single', 'alias' => 'MANHATTAN', 'nombre' => 'MANHATTAN REVOLUTION 500', 'bar' => 'Maigmo'], // CONFIRMADA
            ['identificador' => 'B:RGQ:25 V:001982', 'type' => 'single', 'alias' => 'NOVOLINE', 'nombre' => 'NOVOLINE ROYAL GOLD', 'bar' => 'Maigmo'], // CONFIRMADA
            //['identificador' => 'B:SAQ:21 V:065081', 'type' => 'single', 'alias' => 'SAMARKANDA', 'nombre' => 'SAMARKANDA 500', 'bar' => 'Almacén'], //
            // ['identificador' => 'B:SAQ:21 V:065083', 'type' => 'single', 'alias' => 'SAMARKANDA', 'nombre' => 'SAMARKANDA 500', 'bar' => 'Almacén'], //
            ['identificador' => 'B:PLQ:21 V:062933', 'type' => 'single', 'alias' => 'PINGÜINOS', 'nombre' => 'PINGÜINOS LOCOS 500', 'bar' => 'El Cantó'], // CONFIRMADA
            //['identificador' => 'B:VEQ:19 V:016034', 'type' => 'single', 'alias' => 'VENECIA', 'nombre' => 'VENECIA MIX 500', 'bar' => 'Angel de Santa Pola'], //
            ['identificador' => 'B:AB1:19 V:010330', 'type' => 'single', 'alias' => 'ACTION STAR', 'nombre' => 'ACTION STAR BAR 500', 'bar' => 'Angel de Santa Pola'], // CONFRIMADA
            //['identificador' => 'B:N3B:19 V:035951', 'type' => 'single', 'alias' => 'NOVOLINE III BAR', 'nombre' => 'NOVOLINE III BAR 500', 'bar' => 'Almacén'], //
            ['identificador' => 'B:MBQ:24 V:000448', 'type' => 'single', 'alias' => 'MANHATTAN', 'nombre' => 'MANHATTAN BOOM', 'bar' => 'Picaeta'], // CONFIRMADA
            ['identificador' => 'B:LBQ:24 V:108724', 'type' => 'single', 'alias' => 'MERKUR DELUXE BAR', 'nombre' => 'MERKUR DELUXE BAR 500', 'bar' => 'Picaeta'], // CONFIRMADA
            ['identificador' => 'B:ARC:19 V:006328', 'type' => 'single', 'alias' => 'ARCADE', 'nombre' => 'ARCADE 500', 'bar' => 'Starkoffe'], // CONFIRMADO
            //['identificador' => 'B:AB1:19 V:010350', 'type' => 'single', 'alias' => 'ACTION STAR BAR', 'nombre' => 'ACTION STAR BAR 500', 'bar' => 'Caballer'], // no pertenete a este bar
            ['identificador' => 'B:MHR:22 V:001423', 'type' => 'single', 'alias' => 'MANHATTAN', 'nombre' => 'MANHATTAN REVOLUTION 500', 'bar' => 'Bulevar'], // CONFIRMADA
            ['identificador' => 'B:SEQ:25 V:001564', 'type' => 'single', 'alias' => 'SEVEN POWER UP', 'nombre' => 'SEVEN POWER UP 500', 'bar' => 'Bulevar'], // CONFIRMADA
            //['identificador' => 'B:SEQ:25 V:001564', 'type' => 'single', 'alias' => 'PINGÜINOS', 'nombre' => 'PINGÜINOS LOCOS 500', 'bar' => 'Taller'], // CONFIRMADA
            ['identificador' => 'B:MHR:22 V:001421', 'type' => 'single', 'alias' => 'MANHATTAN', 'nombre' => 'MANHATTAN REVOLUTION 500', 'bar' => 'Parada'], // CONFIRMADA
            ['identificador' => 'B:FXQ:23 V:004209', 'type' => 'single', 'alias' => 'FENIX', 'nombre' => 'FENIX 500', 'bar' => 'D´Angelo'], // CONFIRMADA
            ['identificador' => 'B:ARC:19 V:006330', 'type' => 'single', 'alias' => 'ARCADE', 'nombre' => 'ARCADE 500', 'bar' => 'Coratge'], // CONFIRMADA
            ['identificador' => 'B:RLQ:24 V:002247', 'type' => 'single', 'alias' => 'ROCKET LINK BAR', 'nombre' => 'ROCKET LINK 500', 'bar' => 'Coratge'], // CONFIRMADA
            ['identificador' => 'B:NFQ:19 V:006815', 'type' => 'single', 'alias' => 'NEFERTARI', 'nombre' => 'NEFERTARI 500', 'bar' => 'Tramusser'], // CONFIRMADA
            //['identificador' => 'B:REY:19 V:003328', 'type' => 'single', 'alias' => 'REY DE LA SUERTE', 'nombre' => 'MERKUR REY DE LA SUERTE 500', 'bar' => 'Almacén'], //
            //['identificador' => 'B:N3B:19 V:035951', 'type' => 'single', 'alias' => 'NOVOLINE', 'nombre' => 'NOVOLINE III BAR 500', 'bar' => 'Almacén'], //
            ['identificador' => 'B:MBQ:24 V:000141', 'type' => 'single', 'alias' => 'MANHATTAN', 'nombre' => 'MANHATTAN BOOM 500', 'bar' => 'Madrigueres 64'], // CONFIRMADA
            ['identificador' => 'B:MRG:25 V:000367', 'type' => 'single', 'alias' => 'MANHATTAN', 'nombre' => 'MANHATTAN MIRAGE', 'bar' => 'Madrigueres 64'], // CONFIRMADA
            ['identificador' => 'B:PLQ:21 V:062931', 'type' => 'single', 'alias' => 'PINGÜINOS', 'nombre' => 'PINGÜINOS LOCOS 500', 'bar' => 'Mas y Mas'], // CONFIRMADA
            ['identificador' => 'B:MHR:22 V:001324', 'type' => 'single', 'alias' => 'MANHATTAN', 'nombre' => 'MANHATTAN REVOLUTION 500', 'bar' => 'Sport'], // CONFIRMADA
            //['identificador' => 'B:SAQ:21 V:065082', 'type' => 'single', 'alias' => 'SAMARKANDA', 'nombre' => 'SAMARKANDA 500', 'bar' => 'Almacén'], // no pertenece al bar
            ['identificador' => 'B:SAQ:21 V:065082', 'type' => 'single', 'alias' => 'SAMARKANDA', 'nombre' => 'SAMARKANDA 500', 'bar' => 'Pedrera'], //
            //['identificador' => 'B:REY:19 V:003334', 'type' => 'single', 'alias' => 'REY DE LA SUERTE', 'nombre' => 'MERKUR REY DE LA SUERTE 500', 'bar' => 'La Maya'], // hay otra maquina en este bar
            ['identificador' => 'B:PYQ:24 V:000071', 'type' => 'single', 'alias' => 'PYRAMID CASH', 'nombre' => 'PYRAMID CASH BAR', 'bar' => 'Bar La Maya'], // CONFIRMADA
            ['identificador' => 'B:HLQ:24 V:000039', 'type' => 'single', 'alias' => 'HIT DE LINK', 'nombre' => 'HIT DE LINK 500', 'bar' => '8 de Copes'], // CONFIRMADA
            ['identificador' => 'B:REY:19 V:003337', 'type' => 'single', 'alias' => 'REY DE LA SUERTE', 'nombre' => 'MERKUR REY DE LA SUERTE 500', 'bar' => 'Pulpo Pirata'], // CONFIRMADA
            ['identificador' => 'B:PAQ:24 V:000847', 'type' => 'single', 'alias' => 'MANHATTAN', 'nombre' => 'MANHATTAN PARTY 500', 'bar' => 'Pulpo Pirata'], // COONFIRMADA
            ['identificador' => 'B:SAQ:21 V:065084', 'type' => 'single', 'alias' => 'SAMARKANDA', 'nombre' => 'SAMARKANDA 500', 'bar' => 'Angel de Benidorm'], // CONFIRMADA
            ['identificador' => 'B:REY:19 V:003333', 'type' => 'single', 'alias' => 'REY DE LA SUERTE', 'nombre' => 'MERKUR REY DE LA SUERTE 500', 'bar' => 'Picadilly Mediterráneo'], // CONFIRMADA
            ['identificador' => 'B:PLQ:21 V:064289', 'type' => 'single', 'alias' => 'PINGÜINOS', 'nombre' => 'PINGÜINOS LOCOS 500', 'bar' => 'Veneto'], // CONFIRMADA
            ['identificador' => 'B:MHR:22 V:001325', 'type' => 'single', 'alias' => 'MANHATTAN', 'nombre' => 'MANHATTAN REVOLUTION 500', 'bar' => 'Veneto'], // CONFIRMADA
            ['identificador' => 'B:N3B:19 V:035950', 'type' => 'single', 'alias' => 'NOVOLINE III BAR', 'nombre' => 'NOVOLINE III BAR 500', 'bar' => 'Zarcar'], // CONFIRMADA
            ['identificador' => 'B:REY:19 V:003335', 'type' => 'single', 'alias' => 'REY DE LA SUERTE', 'nombre' => 'MERKUR REY DE LA SUERTE 500', 'bar' => 'Albeniz'], // CONFIRMADA
            ['identificador' => 'B:MHR:23 V:001363', 'type' => 'single', 'alias' => 'MANHATTAN', 'nombre' => 'MANHATTAN REVOLUTION 500', 'bar' => 'Puntxaetes'], // CONFIRMADA
            ['identificador' => 'B:PLQ:21 V:064290', 'type' => 'single', 'alias' => 'PINGÜINOS', 'nombre' => 'PINGÜINOS LOCOS 500', 'bar' => 'Puntxaetes'], // CONFIRMADA
            ['identificador' => 'B:MHR:24 V:001424', 'type' => 'single', 'alias' => 'MANHATTAN', 'nombre' => 'MANHATTAN REVOLUTION 500', 'bar' => 'De Aca y Alla'], // CONFIRMADA
            ['identificador' => 'B:PAQ:24 V:000842', 'type' => 'single', 'alias' => 'MANHATTAN', 'nombre' => 'MANHATTAN PARTY 500', 'bar' => 'Yorkos'], // CONFIRMADA
            ['identificador' => 'B:RCQ:21 V:064255', 'type' => 'single', 'alias' => 'ROYAL CASH BAR', 'nombre' => 'NOVOLINE ROYAL CASH BAR 500', 'bar' => 'Yorkos'], // CONFIRMADA
            ['identificador' => 'B:HLQ:24 V:000037', 'type' => 'single', 'alias' => 'HIT DE LINK', 'nombre' => 'HIT DE LINK 500', 'bar' => 'El Sol'], // CONFIRMADA
            ['identificador' => 'B:AB1:19 V:010340', 'type' => 'single', 'alias' => 'ACTION STAR', 'nombre' => 'ACTION STAR BAR 500', 'bar' => 'El Sol'], // CONFIRMADA
            ['identificador' => 'B:HLQ:24 V:000162', 'type' => 'single', 'alias' => 'HIT THE LINK', 'nombre' => 'HIT THE LINK 500', 'bar' => 'La Grada Deportiva'], // CONFIRMADA
            ['identificador' => 'B:AB1:19 V:010424', 'type' => 'single', 'alias' => 'ACTION STAR', 'nombre' => 'ACTION STAR BAR 500', 'bar' => 'La Grada Deportiva'], // CONFIRMADA
            ['identificador' => 'B:PLQ:21 V:062935', 'type' => 'single', 'alias' => 'PINGÜINOS', 'nombre' => 'PINGÜINOS LOCOS 500', 'bar' => 'Bulevar Benidorm'], // CONFIRMADA
            ['identificador' => 'B:PLQ:21 V:064291', 'type' => 'single', 'alias' => 'PINGÜINOS', 'nombre' => 'PINGÜINOS LOCOS 500', 'bar' => 'New Litte'], // CONFIRMADA
            ['identificador' => 'B:CHQ:18 V:039144', 'type' => 'single', 'alias' => 'CHIRINGUITO', 'nombre' => 'CHIRINGUITO 500 BEACH', 'bar' => 'Caballer'], // CONFIRMADA
            ['identificador' => 'B:MHR:23 V:001326', 'type' => 'single', 'alias' => 'MANHATTAN', 'nombre' => 'MANHATTAN REVOLUTION 500', 'bar' => 'Las Tablas'], // CONFIRMADA
            ['identificador' => 'B:PWQ:22 V:077386', 'type' => 'single', 'alias' => 'POWER CASH', 'nombre' => 'NOVOLINE POWER CASH 500', 'bar' => 'Las Tablas'], // CONFIRMADA
            ['identificador' => 'B:HLQ:24 V:000161', 'type' => 'single', 'alias' => 'HIT DE LINK', 'nombre' => 'HIT DE LINK 500', 'bar' => 'Picadilly'], // CONFIRMADA

            /*['identificador' => 'B:PIQ:15 V:000359', 'alias' => 'PIRATA DEL CARIBE', 'nombre' => 'PIRATAS CARIBE 500', 'bar' => 'Almacen'],
            ['identificador' => 'B:OCQ:15 V:000193', 'alias' => 'OCEAN', 'nombre' => 'OCEAN 500', 'bar' => 'Almacen'],
            ['identificador' => 'B:HEQ:15 V:000007', 'alias' => 'GRAN HERMANO', 'nombre' => 'GRAN HERMANO 500', 'bar' => 'Almacen'],
            ['identificador' => 'B:YEQ:15 V:000271', 'alias' => 'YETIMANIA', 'nombre' => 'YETIMANIA 500', 'bar' => 'Almacen'],
            ['identificador' => 'B:NFQ:19 V:006816', 'alias' => 'NEFERTARI', 'nombre' => 'NEFERTARI 500', 'bar' => 'Almacen'],
            ['identificador' => 'B:CHQ:18 V:039142', 'alias' => 'CHIRINGUITO', 'nombre' => 'CHIRINGUITO 500 BEACH', 'bar' => 'Almacen'],
            ['identificador' => 'B:CHQ:18 V:039145', 'alias' => 'CHIRINGUITO', 'nombre' => 'CHIRINGUITO 500 BEACH', 'bar' => 'Almacen'],
            ['identificador' => 'B:CHQ:18 V:039143', 'alias' => 'CHIRINGUITO', 'nombre' => 'CHIRINGUITO 500 BEACH', 'bar' => 'Almacen'],
            ['identificador' => 'B:NLB:16 V:686780', 'alias' => 'NOVOLINE II BAR', 'nombre' => 'NOVOLINE II BAR 500', 'bar' => 'Almacen'],
            ['identificador' => 'B:CHQ:18 V:039141', 'alias' => 'CHIRINGUITO', 'nombre' => 'CHIRINGUITO 500 BEACH', 'bar' => 'Almacen'],
            ['identificador' => 'B:ARC:19 V:006325', 'alias' => 'RF ARCADE', 'nombre' => 'RF ARCADE 500', 'bar' => 'Almacen'],
            ['identificador' => 'B:PIQ:15 V:000406', 'alias' => 'PIRATA DEL CARIBE', 'nombre' => 'PIRATAS CARIBE 500', 'bar' => 'Almacen'],
            ['identificador' => 'B:REY:19 V:003334', 'alias' => 'REY DE LA SUERTE', 'nombre' => 'REY DE LA SUERTE 500', 'bar' => 'Almacen'],
            ['identificador' => 'B:DOQ:16 V:017673', 'alias' => 'DORADO', 'nombre' => 'EL DORADO 500', 'bar' => 'Almacen'],
            ['identificador' => 'B:REY:19 V:003332', 'alias' => 'REY DE LA SUERTE', 'nombre' => 'REY DE LA SUERTE 500', 'bar' => 'Almacen'],
            ['identificador' => 'B:PLQ:21 V:064285', 'alias' => 'PINGÜINOS', 'nombre' => 'GIGAMES PINGÜINOS LOCOS', 'bar' => 'Almacen'],
            ['identificador' => 'B:PLQ:21 V:064290', 'alias' => 'PINGÜINOS', 'nombre' => 'GIGAMES PINGÜINOS LOCOS', 'bar' => 'Almacen'],
            ['identificador' => 'B:DOQ:16 V:017676', 'alias' => 'DORADO', 'nombre' => 'EL DORADO 500', 'bar' => 'Almacen'],
            ['identificador' => 'B:SAQ:21 V:065085', 'alias' => 'SAMARKANDA', 'nombre' => 'GIGAMES SAMARKANDA', 'bar' => 'Almacen'],*/
        ];


        foreach ($maquinasBares as $maquina) {
            $bar = Bar::where('name', $maquina['bar'])->first();
            //dd($bar);
            $machine = Machine::create([
                'identificador' => $maquina['identificador'],
                'name' => $maquina['nombre'],
                'alias' => $maquina['alias'],
                'bar_id' => $bar->id,
                'type' => $maquina['type'],
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }

        // DATAFONO APUESTAS Y CAMBIO
        $paraRecargasAuxiliares = [
            ['identificador' => 'CAMBIO', 'type' => 'single', 'alias' => 'CAMBIO', 'nombre' => 'CAMBIO'],
            ['identificador' => 'DATAFONO', 'type' => 'single', 'alias' => 'DATAFONO', 'nombre' => 'DATAFONO'],
            ['identificador' => 'APUESTAS', 'type' => 'single', 'alias' => 'APUESTAS DEPORTIVAS', 'nombre' => 'APUESTAS DEPORTIVAS'],
            ['identificador' => 'ACUMULADO', 'type' => 'single', 'alias' => 'ACUMULADO', 'nombre' => 'ACUMULADO']
        ];

        // Obtener todos los salones en la delegación 1
        $salones = Local::all();

        foreach ($paraRecargasAuxiliares as $Aux) {
            foreach ($salones as $local) { // Iterar sobre cada salón
                // Crear un identificador único para la máquina
                $identificadorUnico = $Aux['identificador'] . '_' . $local->name;

                $machine = Machine::create([
                    'identificador' => $identificadorUnico, // Usar identificador único
                    'type' => $Aux['type'],
                    'name' => $Aux['nombre'], // Usar nombre del auxiliar
                    'alias' => $Aux['alias'], // Usar alias del auxiliar
                    'local_id' => $local->id, // Asociar a cada salón
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }
        }
    }
}

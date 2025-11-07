<?php

namespace Database\Seeders;

use App\Models\Local;
use Illuminate\Database\Seeder;

class LocalSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            // Zona 1: Benidorm
            [
                'name' => 'Muchamiel',
                'idMachines' => '1640',
                'dbconnection' => [
                    ['name' => 'Conexión principal', 'ip' => '213.96.203.239', 'port' => '2069', 'database' => 'ticketserver', 'username' => 'ccm', 'password' => 'ccm10'],
                ],
            ],
            [
                'name' => 'Villajoyosa',
                'idMachines' => '1641',
                'dbconnection' => [
                    ['name' => 'Conexión principal', 'ip' => '185.207.144.80', 'port' => '4041', 'database' => 'ticketserver', 'username' => 'ccm', 'password' => 'ccm10'],
                ],
            ],
            [
                'name' => 'La Nucia',
                'idMachines' => '1620',
                'dbconnection' => [
                    ['name' => 'Conexión principal', 'ip' => '80.26.56.90', 'port' => '5164', 'database' => 'ticketserver', 'username' => 'ccm', 'password' => 'ccm10'],
                ],
            ],
            [
                'name' => 'Benisa',
                'idMachines' => '1570',
                'dbconnection' => [
                    ['name' => 'Conexión principal', 'ip' => '217.127.52.195', 'port' => '2376', 'database' => 'ticketserver', 'username' => 'ccm', 'password' => 'ccm10'],
                ],
            ],

            // Zona 2: Alicante
            [
                'name' => 'Jaime Segarra',
                'idMachines' => '14202',
                'zone_id' => 2,
                'dbconnection' => [
                    ['name' => 'Conexión principal', 'ip' => '80.29.124.106', 'port' => '7398', 'database' => 'ticketserver', 'username' => 'ccm', 'password' => 'ccm10'],
                ],
            ],
            [
                'name' => 'Florida',
                'idMachines' => '1610',
                'zone_id' => 2,
                'dbconnection' => [
                    ['name' => 'Conexión principal', 'ip' => '213.97.83.21', 'port' => '1528', 'database' => 'ticketserver', 'username' => 'ccm', 'password' => 'ccm10'],
                ],
            ],
            [
                'name' => 'Pardo Gimeno',
                'idMachines' => '14246',
                'zone_id' => 2,
                'dbconnection' => [
                    ['name' => 'Conexión principal', 'ip' => '80.26.56.86', 'port' => '6056', 'database' => 'ticketserver', 'username' => 'ccm', 'password' => 'ccm10'],
                ],
            ],
            [
                'name' => 'Primo de Rivera',
                'idMachines' => '14159',
                'zone_id' => 2,
                'dbconnection' => [
                    ['name' => 'Conexión principal', 'ip' => '2.139.179.94', 'port' => '3251', 'database' => 'ticketserver', 'username' => 'ccm', 'password' => 'ccm10'],
                ],
            ],

            // Zona 3: Javea
            [
                'name' => 'Gata de Gorgos',
                'idMachines' => '14245',
                'zone_id' => 3,
                'dbconnection' => [
                    ['name' => 'Conexión principal', 'ip' => '185.105.18.156', 'port' => '3817', 'database' => 'ticketserver', 'username' => 'ccm', 'password' => 'ccm10'],
                ],
            ],
            [
                'name' => 'Javea',
                'idMachines' => '1921',
                'zone_id' => 3,
                'dbconnection' => [
                    ['name' => 'Conexión principal', 'ip' => '92.59.224.15', 'port' => '8428', 'database' => 'ticketserver', 'username' => 'ccm', 'password' => 'ccm10'],
                ],
            ],
            [
                'name' => 'Teulada',
                'idMachines' => '2038',
                'zone_id' => 3,
                'dbconnection' => [
                    ['name' => 'Conexión principal', 'ip' => '109.234.80.10', 'port' => '9139', 'database' => 'ticketserver', 'username' => 'ccm', 'password' => 'ccm10'],
                ],
            ],
            [
                'name' => 'Calpe',
                'idMachines' => '2055',
                'zone_id' => 3,
                'dbconnection' => [
                    ['name' => 'Conexión principal', 'ip' => '90.75.246.3', 'port' => '2650', 'database' => 'ticketserver', 'username' => 'ccm', 'password' => 'ccm10'],
                ],
            ],

            // Zona 4: Denia
            [
                'name' => 'Denia',
                'idMachines' => '1554',
                'zone_id' => 4,
                'dbconnection' => [
                    ['name' => 'Conexión principal', 'ip' => '2.139.215.188', 'port' => '6015', 'database' => 'ticketserver', 'username' => 'ccm', 'password' => 'ccm10'],
                ],
            ],
            [
                'name' => 'Ondara',
                'idMachines' => '17363',
                'zone_id' => 4,
                'dbconnection' => [
                    ['name' => 'Conexión principal', 'ip' => '217.127.50.205', 'port' => '8061', 'database' => 'ticketserver', 'username' => 'ccm', 'password' => 'ccm10'],
                ],
            ],
            [
                'name' => 'Vergel',
                'idMachines' => '2037',
                'zone_id' => 4,
                'dbconnection' => [
                    ['name' => 'Conexión principal', 'ip' => '185.191.89.209', 'port' => '5007', 'database' => 'ticketserver', 'username' => 'ccm', 'password' => 'ccm10'],
                ],
            ],
            [
                'name' => 'Pego',
                'idMachines' => '1550',
                'zone_id' => 4,
                'dbconnection' => [
                    ['name' => 'Conexión principal', 'ip' => '185.126.234.37', 'port' => '3976', 'database' => 'ticketserver', 'username' => 'ccm', 'password' => 'ccm10'],
                ],
            ],
            // Zona 4: Taller
            /*[
                'name' => 'Servidor',
                'idMachines' => '123',
                'dbconnection' => [
                    ['name' => 'Conexión principal', 'ip' => '192.168.1.129', 'port' => '3306', 'database' => 'ticketserver', 'username' => 'ccm', 'password' => 'ccm10'],
                ],
            ],
            [
                'name' => 'Maquina virtual',
                'idMachines' => '12345',
                'dbconnection' => [
                    ['name' => 'Conexión principal', 'ip' => '192.168.1.127', 'port' => '3306', 'database' => 'ticketserver', 'username' => 'ccm', 'password' => 'ccm10'],
                ],
            ],
            [
                'name' => 'Maquina física',
                'idMachines' => '123456',
                'dbconnection' => [
                    ['name' => 'Conexión principal', 'ip' => '192.168.1.125', 'port' => '3306', 'database' => 'ticketserver', 'username' => 'ccm', 'password' => 'ccm10'],
                ],
            ],*/
            [
                'name' => 'Nave Taller',
                'idMachines' => '123123',
                'dbconnection' => [
                    ['name' => 'Conexión principal', 'ip' => '192.168.1.129', 'port' => '3306', 'database' => 'ticketserver', 'username' => 'ccm', 'password' => 'ccm10'],
                    ['name' => 'Máquina 1', 'ip' => '192.168.1.125', 'port' => '3306', 'database' => 'ticketserver', 'username' => 'ccm', 'password' => 'ccm10'],
                    ['name' => 'Máquina 2', 'ip' => '192.168.1.127', 'port' => '3306', 'database' => 'ticketserver', 'username' => 'ccm', 'password' => 'ccm10'],
                ],
            ],
            // Nuevos locales para la delegación de Orenes
            /*[
                'name' => 'Granada Local 1',
                'idMachines' => '2001',
                'zone_id' => 6, // Asegúrate de que este ID de zona exista
                'dbconnection' => [
                    ['name' => 'Conexión principal', 'ip' => '80.29.124.101', 'port' => '7398', 'database' => 'ticketserver', 'username' => 'ccm', 'password' => 'ccm10'],
                ],
            ],
            [
                'name' => 'Malaga Local 1',
                'idMachines' => '2002',
                'zone_id' => 7, // Asegúrate de que este ID de zona exista
                'dbconnection' => [
                    ['name' => 'Conexión principal', 'ip' => '80.29.124.102', 'port' => '7398', 'database' => 'ticketserver', 'username' => 'ccm', 'password' => 'ccm10'],
                ],
            ],

            // Nuevos locales para la delegación de Luckia
            [
                'name' => 'Sevilla Local 1',
                'idMachines' => '3001',
                'zone_id' => 8, // Asegúrate de que este ID de zona exista
                'dbconnection' => [
                    ['name' => 'Conexión principal', 'ip' => '80.29.124.201', 'port' => '7398', 'database' => 'ticketserver', 'username' => 'ccm', 'password' => 'ccm10'],
                ],
            ],
            [
                'name' => 'Cadiz Local 1',
                'idMachines' => '3002',
                'zone_id' => 9, // Asegúrate de que este ID de zona exista
                'dbconnection' => [
                    ['name' => 'Conexión principal', 'ip' => '80.29.124.202', 'port' => '7398', 'database' => 'ticketserver', 'username' => 'ccm', 'password' => 'ccm10'],
                ],
            ],*/
        ];

        // Recorremos los datos y creamos los registros correspondientes en la base de datos.
        collect($data)->each(function ($zone) {
            Local::create([
                'name' => $zone['name'],
                'idMachines' => $zone['idMachines'],
                'dbconection' => json_encode($zone['dbconnection']),
            ]);
        });
    }
}

<?php

namespace Database\Seeders;

use App\Models\Delegation;
use App\Models\Local;
use App\Models\User;
use Illuminate\Database\Seeder;
use Laravel\Passport\Client;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $prometeo = User::factory()->create([
            'name' => 'Prometeo',
            'email' => 'prometeo@magarin.es',
            'password' => bcrypt('Admin1234'),
        ]);
        $prometeo->save();

        $fran = User::factory()->create([
            'name' => 'Fran',
            'email' => 'franciscoexposito@magarin.es',
            'password' => bcrypt('Fran1234'),
        ]);

        $fran->save();

        $Pepe = User::factory()->create([
            'name' => 'Pepe',
            'email' => 'jmpalazon@magarin.es',
            'password' => bcrypt('Magarin1234'),
        ]);

        $Pepe->save();

        $Benidorm = User::factory()->create([
            'name' => 'Benidorm',
            'email' => 'Benidorm@magarin.es',
            'password' => bcrypt('Magarin1234'),
        ]);

        $Benidorm->save();

        $Ricardo = User::factory()->create([
            'name' => 'Ricardo',
            'email' => 'ricardogranados@magarin.es',
            'password' => bcrypt('Magarin1234'),
        ]);

        $Ricardo->save();

        $Rafael = User::factory()->create([
            'name' => 'Rafael',
            'email' => 'rafaelgranados@magarin.es',
            'password' => bcrypt('Magarin1234'),
        ]);

        $Rafael->save();

        $JF = User::factory()->create([
            'name' => 'JuanFran',
            'email' => 'juanfranciscogarcia@magarin.es',
            'password' => bcrypt('Magarin1234'),
        ]);

        $JF->save();

        $Ramon = User::factory()->create([
            'name' => 'Ramon',
            'email' => 'ramontrujillo@magarin.es',
            'password' => bcrypt('Magarin1234'),
        ]);

        $Ramon->save();

        $Antonio = User::factory()->create([
            'name' => 'Antonio',
            'email' => 'antoniovicens@magarin.es',
            'password' => bcrypt('Magarin1234'),
        ]);

        $Antonio->save();

        $Daniel = User::factory()->create([
            'name' => 'Daniel',
            'email' => 'danielaguirre@magarin.es',
            'password' => bcrypt('Magarin1234'),
        ]);

        $Daniel->save();

        $Sergio = User::factory()->create([
            'name' => 'Sergio',
            'email' => 'sergioespana@magarin.es',
            'password' => bcrypt('Magarin1234'),
        ]);

        $Sergio->save();

        $Salmeron = User::factory()->create([
            'name' => 'Salmeron',
            'email' => 'antoniosalmeron@magarin.es',
            'password' => bcrypt('Magarin1234'),
        ]);

        $Salmeron->save();

        $Mauricio = User::factory()->create([
            'name' => 'Mauricio',
            'email' => 'mauricioirady@magarin.es',
            'password' => bcrypt('Magarin1234'),
        ]);

        $Mauricio->save();

        $Carlos = User::factory()->create([
            'name' => 'Carlos',
            'email' => 'carlos@magarin.es',
            'password' => bcrypt('Magarin1234'),
        ]);

        $Carlos->save();

        $Lucia = User::factory()->create([
            'name' => 'Lucia',
            'email' => 'luciajimenez@magarin.es',
            'password' => bcrypt('Magarin1234'),
        ]);

        $Lucia->save();

        $Sebas = User::factory()->create([
            'name' => 'Sebas',
            'email' => 'sebastianospina@magarin.es',
            'password' => bcrypt('Magarin1234'),
        ]);

        $Sebas->save();

        // Crear los usuarios "Mini Prometeo" por cada local
        $locales = Local::all();

        foreach ($locales as $local) {
            $user = User::factory()->create([
                'name' => 'Miniprometeo ' . $local->name,
                'email' => strtolower(str_replace(' ', '_', $local->name)) . '@magarin.es',
                'password' => bcrypt('Mini1234'),
            ]);

            $user->created_at = now();
            $user->updated_at = now();
            $user->save();

            /* Si más adelante quieres volver a activar Passport:
            Client::create([
                'user_id' => $user->id,
                'name' => 'Cliente para ' . $local->name,
                'redirect' => '',
                'personal_access_client' => false,
                'password_client' => true,
                'revoked' => false,
                'secret' => bcrypt('Secret' . $user->id),
            ]);
            */
        }
    }
}

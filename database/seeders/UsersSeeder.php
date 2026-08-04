<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UsersSeeder extends Seeder
{
    public function run(): void
    {
        $password = env('SEED_ADMIN_PASSWORD');

        if (blank($password)) {
            $this->command?->warn('Usuario de desarrollo omitido: define SEED_ADMIN_PASSWORD para crearlo.');

            return;
        }

        User::updateOrCreate(
            ['email' => env('SEED_ADMIN_EMAIL', 'admin@magarin.es')],
            [
                'name' => env('SEED_ADMIN_NAME', 'Admin Supremo'),
                'password' => Hash::make($password),
            ],
        );
    }
}

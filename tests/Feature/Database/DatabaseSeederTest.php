<?php

namespace Tests\Feature\Database;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class DatabaseSeederTest extends TestCase
{
    use RefreshDatabase;

    public function test_seeders_are_idempotent(): void
    {
        $expectedUsers = blank(env('SEED_ADMIN_PASSWORD')) ? 0 : 1;

        $this->seed();
        $this->seed();

        $this->assertDatabaseCount('factories', 2);
        $this->assertDatabaseCount('states', 5);
        $this->assertDatabaseCount('locals', 17);
        $this->assertDatabaseCount('bars', 2);
        $this->assertDatabaseCount('machines', 3);
        $this->assertDatabaseCount('spare_parts', 2);
        $this->assertDatabaseCount('delivery_notes', 1);
        $this->assertDatabaseCount('users', $expectedUsers);

        $this->assertDatabaseHas('locals', ['name' => 'Muchamiel', 'idMachines' => '1640']);
        $this->assertDatabaseHas('bars', ['name' => 'Bar de demostración Centro']);
    }
}

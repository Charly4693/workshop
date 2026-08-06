<?php

namespace Tests\Feature\Prometeo;

use App\Exceptions\PrometeoSyncException;
use App\Models\User;
use App\Services\PrometeoSyncService;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Tests\TestCase;

class PrometeoSyncTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();

        config()->set('database.connections.prometeo', [
            'driver' => 'sqlite',
            'database' => ':memory:',
            'prefix' => '',
            'foreign_key_constraints' => true,
        ]);

        DB::purge('prometeo');
        $this->createPrometeoSchema();
    }

    public function test_it_synchronizes_the_three_catalogs_and_is_idempotent(): void
    {
        $admin = User::factory()->create();
        $timestamp = now()->subDay()->toDateTimeString();

        DB::connection('prometeo')->table('locals')->insert([
            'id' => 10,
            'name' => 'Salón Prometeo',
            'dbconection' => json_encode(['host' => '192.0.2.10']),
            'idMachines' => 'LOCAL-10',
            'created_at' => $timestamp,
            'updated_at' => $timestamp,
        ]);
        DB::connection('prometeo')->table('bars')->insert([
            'id' => 20,
            'name' => 'Bar Prometeo',
            'holder' => 'Titular Prometeo',
            'dni_cif' => 'B12345678',
            'address' => 'Calle Prometeo, 1',
            'town' => 'Alicante',
            'created_at' => $timestamp,
            'updated_at' => $timestamp,
        ]);
        DB::connection('prometeo')->table('machines')->insert([
            [
                'id' => 100,
                'name' => 'Máquina padre',
                'alias' => 'PADRE-100',
                'local_id' => 10,
                'bar_id' => null,
                'identificador' => 'ID-100',
                'type' => 'parent',
                'parent_id' => null,
                'created_at' => $timestamp,
                'updated_at' => $timestamp,
            ],
            [
                'id' => 101,
                'name' => 'Máquina AADD',
                'alias' => 'AADD-101',
                'local_id' => 10,
                'bar_id' => null,
                'identificador' => 'ID-101',
                'type' => 'AADD',
                'parent_id' => 100,
                'created_at' => $timestamp,
                'updated_at' => $timestamp,
            ],
            [
                'id' => 102,
                'name' => 'Máquina de bar',
                'alias' => 'BAR-102',
                'local_id' => null,
                'bar_id' => 20,
                'identificador' => 'ID-102',
                'type' => 'single',
                'parent_id' => null,
                'created_at' => $timestamp,
                'updated_at' => $timestamp,
            ],
        ]);

        DB::table('locals')->insert([
            'id' => 10,
            'name' => 'Nombre antiguo',
            'dbconection' => json_encode(['host' => '192.0.2.99']),
            'idMachines' => 'LOCAL-ANTIGUO',
            'is_active' => true,
            'created_at' => $timestamp,
            'updated_at' => $timestamp,
        ]);
        DB::table('locals')->insert([
            'id' => 99,
            'name' => 'Local ya no presente',
            'dbconection' => json_encode(['host' => '192.0.2.99']),
            'idMachines' => 'LOCAL-99',
            'is_active' => true,
            'created_at' => $timestamp,
            'updated_at' => $timestamp,
        ]);

        $firstRun = app(PrometeoSyncService::class)->synchronize($admin);

        $this->assertSame('success', $firstRun->status);
        $this->assertSame($admin->id, $firstRun->user_id);
        $this->assertSame(1, $firstRun->counts['locals']['updated']);
        $this->assertSame(1, $firstRun->counts['locals']['inactivated']);
        $this->assertSame(3, $firstRun->counts['machines']['created']);
        $this->assertDatabaseHas('locals', ['id' => 10, 'name' => 'Salón Prometeo', 'is_active' => true]);
        $this->assertDatabaseHas('locals', ['id' => 99, 'is_active' => false]);
        $this->assertDatabaseHas('machines', ['id' => 101, 'type' => 'AADD', 'parent_id' => 100]);
        $this->assertSame(1, DB::connection('prometeo')->table('locals')->count());
        $this->assertSame(3, DB::connection('prometeo')->table('machines')->count());

        $secondRun = app(PrometeoSyncService::class)->synchronize($admin);

        $this->assertSame(0, collect($secondRun->counts)->sum('created'));
        $this->assertSame(0, collect($secondRun->counts)->sum('updated'));
        $this->assertSame(5, collect($secondRun->counts)->sum('unchanged'));
    }

    public function test_an_invalid_snapshot_is_rejected_without_partial_catalog_changes(): void
    {
        $timestamp = now()->toDateTimeString();

        DB::connection('prometeo')->table('locals')->insert([
            'id' => 10,
            'name' => 'Local válido',
            'dbconection' => '{}',
            'idMachines' => 'LOCAL-10',
            'created_at' => $timestamp,
            'updated_at' => $timestamp,
        ]);
        DB::connection('prometeo')->table('bars')->insert([
            'id' => 20,
            'name' => 'Bar válido',
            'holder' => 'Titular',
            'dni_cif' => 'B12345678',
            'address' => 'Calle 1',
            'town' => 'Alicante',
            'created_at' => $timestamp,
            'updated_at' => $timestamp,
        ]);
        DB::connection('prometeo')->table('machines')->insert([
            'id' => 100,
            'name' => 'Máquina inválida',
            'alias' => 'INVALIDA',
            'local_id' => 999,
            'bar_id' => null,
            'identificador' => 'ID-100',
            'type' => 'single',
            'parent_id' => null,
            'created_at' => $timestamp,
            'updated_at' => $timestamp,
        ]);

        try {
            app(PrometeoSyncService::class)->synchronize();
            $this->fail('La instantánea inválida debería haber sido rechazada.');
        } catch (PrometeoSyncException $exception) {
            $this->assertStringContainsString('local inexistente', $exception->getMessage());
        }

        $this->assertDatabaseCount('locals', 0);
        $this->assertDatabaseCount('bars', 0);
        $this->assertDatabaseCount('machines', 0);
        $this->assertDatabaseHas('prometeo_sync_runs', ['status' => 'failed']);
    }

    private function createPrometeoSchema(): void
    {
        Schema::connection('prometeo')->create('locals', function (Blueprint $table): void {
            $table->id();
            $table->string('name');
            $table->text('dbconection');
            $table->string('idMachines');
            $table->timestamps();
        });

        Schema::connection('prometeo')->create('bars', function (Blueprint $table): void {
            $table->id();
            $table->string('name');
            $table->string('holder');
            $table->string('dni_cif');
            $table->string('address');
            $table->string('town');
            $table->timestamps();
        });

        Schema::connection('prometeo')->create('machines', function (Blueprint $table): void {
            $table->id();
            $table->string('name');
            $table->string('alias');
            $table->unsignedBigInteger('local_id')->nullable();
            $table->unsignedBigInteger('bar_id')->nullable();
            $table->string('identificador');
            $table->string('type')->nullable();
            $table->unsignedBigInteger('parent_id')->nullable();
            $table->timestamps();
        });
    }
}

<?php

namespace Tests\Feature\Filament\Resources;

use App\Filament\RelationManagers\MachinesRelationManager;
use App\Filament\Resources\Bars\BarResource;
use App\Filament\Resources\Bars\Pages\ViewBar;
use App\Filament\Resources\Locals\LocalResource;
use App\Filament\Resources\Locals\Pages\ViewLocal;
use App\Filament\Resources\Machines\MachineResource;
use App\Models\Bar;
use App\Models\Local;
use App\Models\Machine;
use App\Models\User;
use Filament\Facades\Filament;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Gate;
use Livewire\Livewire;
use Tests\TestCase;

class PrometeoReadOnlyResourcesTest extends TestCase
{
    use RefreshDatabase;

    public function test_the_manual_sync_page_requires_authentication_and_renders_its_action(): void
    {
        $this->get('/admin/prometeo-sync')->assertRedirect();

        $this->actingAs(User::factory()->create());
        Filament::setCurrentPanel(Filament::getPanel('admin'));

        $this->get('/admin/prometeo-sync')
            ->assertOk()
            ->assertSee('Sincronizar con Prometeo');
    }

    public function test_catalog_resources_only_expose_index_and_view_pages(): void
    {
        $this->actingAs(User::factory()->create());
        Filament::setCurrentPanel(Filament::getPanel('admin'));

        $local = Local::create([
            'name' => 'Salón de prueba',
            'dbconection' => ['host' => '192.0.2.10'],
            'idMachines' => 'LOCAL-1',
        ]);
        $bar = Bar::create([
            'name' => 'Bar de prueba',
            'holder' => 'Titular',
            'dni_cif' => 'B12345678',
            'address' => 'Calle 1',
            'town' => 'Alicante',
        ]);
        $machine = Machine::create([
            'name' => 'Máquina de prueba',
            'alias' => 'MAQ-1',
            'local_id' => $local->id,
            'identificador' => 'ID-1',
            'type' => 'single',
        ]);

        foreach ([
            LocalResource::class => $local,
            BarResource::class => $bar,
            MachineResource::class => $machine,
        ] as $resource => $record) {
            $this->assertSame(['index', 'view'], array_keys($resource::getPages()));
            $this->get($resource::getUrl('index'))->assertOk();
            $this->get($resource::getUrl('view', ['record' => $record]))->assertOk();
            $this->assertTrue(Gate::allows('viewAny', $record::class));
            $this->assertTrue(Gate::allows('view', $record));
            $this->assertFalse(Gate::allows('create', $record::class));
            $this->assertFalse(Gate::allows('update', $record));
            $this->assertFalse(Gate::allows('delete', $record));
        }
    }

    public function test_local_connection_details_are_not_rendered_in_the_admin_resource(): void
    {
        $this->actingAs(User::factory()->create());
        Filament::setCurrentPanel(Filament::getPanel('admin'));

        $local = Local::create([
            'name' => 'Salón sin secretos',
            'dbconection' => ['host' => '198.51.100.42'],
            'idMachines' => 'LOCAL-SEGURO',
        ]);

        $this->get(LocalResource::getUrl('view', ['record' => $local]))
            ->assertOk()
            ->assertDontSee('198.51.100.42');
    }

    public function test_locals_and_bars_list_only_their_own_machines(): void
    {
        $this->actingAs(User::factory()->create());
        Filament::setCurrentPanel(Filament::getPanel('admin'));

        $local = Local::create([
            'name' => 'Salón con máquinas',
            'dbconection' => [],
            'idMachines' => 'LOCAL-MAQUINAS',
        ]);
        $bar = Bar::create([
            'name' => 'Bar con máquinas',
            'holder' => 'Titular',
            'dni_cif' => 'B87654321',
            'address' => 'Calle 2',
            'town' => 'Alicante',
        ]);
        $localMachine = Machine::create([
            'name' => 'Máquina del local',
            'alias' => 'LOCAL-01',
            'local_id' => $local->id,
            'identificador' => 'ID-LOCAL-01',
            'type' => 'single',
        ]);
        $barMachine = Machine::create([
            'name' => 'Máquina del bar',
            'alias' => 'BAR-01',
            'bar_id' => $bar->id,
            'identificador' => 'ID-BAR-01',
            'type' => 'roulette',
        ]);

        $this->assertContains(MachinesRelationManager::class, LocalResource::getRelations());
        $this->assertContains(MachinesRelationManager::class, BarResource::getRelations());

        Livewire::test(MachinesRelationManager::class, [
            'ownerRecord' => $local,
            'pageClass' => ViewLocal::class,
        ])
            ->assertCanSeeTableRecords([$localMachine])
            ->assertCanNotSeeTableRecords([$barMachine]);

        Livewire::test(MachinesRelationManager::class, [
            'ownerRecord' => $bar,
            'pageClass' => ViewBar::class,
        ])
            ->assertCanSeeTableRecords([$barMachine])
            ->assertCanNotSeeTableRecords([$localMachine]);
    }
}

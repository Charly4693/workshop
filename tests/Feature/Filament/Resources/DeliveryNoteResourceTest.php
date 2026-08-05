<?php

namespace Tests\Feature\Filament\Resources;

use App\Filament\Resources\DeliveryNotes\DeliveryNoteResource;
use App\Filament\Resources\DeliveryNotes\Pages\CreateDeliveryNote;
use App\Filament\Resources\DeliveryNotes\Pages\EditDeliveryNote;
use App\Filament\Resources\DeliveryNotes\Pages\ListDeliveryNotes;
use App\Filament\Resources\SpareParts\RelationManagers\StateHistoriesRelationManager;
use App\Filament\Resources\SpareParts\SparePartResource;
use App\Models\Bar;
use App\Models\DeliveryNote;
use App\Models\Factory;
use App\Models\Local;
use App\Models\Machine;
use App\Models\SparePart;
use App\Models\SparePartStateHistory;
use App\Models\State;
use App\Models\User;
use App\Services\DeliveryNoteWorkflow;
use Filament\Actions\Testing\TestAction;
use Filament\Facades\Filament;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Gate;
use Livewire\Livewire;
use Tests\TestCase;

class DeliveryNoteResourceTest extends TestCase
{
    use RefreshDatabase;

    private User $admin;

    protected function setUp(): void
    {
        parent::setUp();

        $this->admin = User::factory()->create(['name' => 'Encargado del taller']);
        $this->actingAs($this->admin);
        Filament::setCurrentPanel(Filament::getPanel('admin'));
    }

    public function test_delivery_notes_can_be_listed_searched_and_filtered(): void
    {
        $workshop = State::create(['name' => 'Taller']);
        $repairing = State::create(['name' => 'Reparación']);
        $technicianNorth = User::factory()->create(['name' => 'Técnico Norte']);
        $technicianSouth = User::factory()->create(['name' => 'Técnico Sur']);
        $local = $this->createLocal('Salón Norte');
        $bar = $this->createBar('Bar Sur');
        $localMachine = $this->createMachine('NORTE-01', local: $local);
        $barMachine = $this->createMachine('SUR-01', bar: $bar);
        $localPart = $this->createSparePart('Monedero Norte', $workshop);
        $barPart = $this->createSparePart('Monedero Sur', $repairing);

        $older = DeliveryNote::create([
            'spare_part_id' => $localPart->id,
            'state_id' => $workshop->id,
            'local_id' => $local->id,
            'machine_id' => $localMachine->id,
            'user_id' => $technicianNorth->id,
        ]);
        $older->forceFill(['created_at' => now()->subDays(5)])->saveQuietly();

        $newer = DeliveryNote::create([
            'spare_part_id' => $barPart->id,
            'state_id' => $repairing->id,
            'bar_id' => $bar->id,
            'machine_id' => $barMachine->id,
            'user_id' => $technicianSouth->id,
        ]);

        Livewire::test(ListDeliveryNotes::class)
            ->assertSuccessful()
            ->assertCanSeeTableRecords([$newer, $older], inOrder: true)
            ->assertTableColumnStateSet('location', 'Salón Norte', $older)
            ->searchTable('Técnico Norte')
            ->assertCanSeeTableRecords([$older])
            ->assertCanNotSeeTableRecords([$newer]);

        Livewire::test(ListDeliveryNotes::class)
            ->filterTable('state_id', $repairing->id)
            ->filterTable('user_id', $technicianSouth->id)
            ->filterTable('bar_id', $bar->id)
            ->filterTable('machine_id', $barMachine->id)
            ->assertCanSeeTableRecords([$newer])
            ->assertCanNotSeeTableRecords([$older]);

        Livewire::test(ListDeliveryNotes::class)
            ->filterTable('local_id', $local->id)
            ->filterTable('created_at', [
                'from' => now()->subDays(6)->toDateString(),
                'until' => now()->subDays(4)->toDateString(),
            ])
            ->assertCanSeeTableRecords([$older])
            ->assertCanNotSeeTableRecords([$newer]);
    }

    public function test_creating_a_delivery_note_updates_the_spare_part_and_records_history(): void
    {
        $workshop = State::create(['name' => 'Taller']);
        $outForTechnician = State::create(['name' => 'Salida para técnico']);
        $technician = User::factory()->create(['name' => 'Técnico receptor']);
        $local = $this->createLocal('Salón principal');
        $machine = $this->createMachine('PRINCIPAL-01', local: $local);
        $sparePart = $this->createSparePart('Monedero físico', $workshop);

        Livewire::test(CreateDeliveryNote::class)
            ->fillForm([
                'spare_part_id' => $sparePart->id,
                'state_id' => $outForTechnician->id,
                'user_id' => $technician->id,
                'local_id' => $local->id,
                'bar_id' => null,
                'machine_id' => $machine->id,
                'comment' => 'Entrega para realizar pruebas',
            ])
            ->call('create')
            ->assertHasNoFormErrors()
            ->assertNotified();

        $deliveryNote = DeliveryNote::query()->firstOrFail();

        $this->assertDatabaseHas('delivery_notes', [
            'id' => $deliveryNote->id,
            'spare_part_id' => $sparePart->id,
            'state_id' => $outForTechnician->id,
            'user_id' => $technician->id,
            'local_id' => $local->id,
            'bar_id' => null,
            'machine_id' => $machine->id,
        ]);
        $this->assertDatabaseHas('spare_parts', [
            'id' => $sparePart->id,
            'state_id' => $outForTechnician->id,
        ]);
        $this->assertDatabaseHas('spare_part_state_histories', [
            'spare_part_id' => $sparePart->id,
            'previous_state_id' => $workshop->id,
            'new_state_id' => $outForTechnician->id,
            'changed_by_user_id' => $this->admin->id,
        ]);
        $this->assertCount(2, $sparePart->stateHistories()->get());
    }

    public function test_editing_and_quick_state_actions_use_the_inventory_workflow(): void
    {
        $workshop = State::create(['name' => 'Taller']);
        $outForTechnician = State::create(['name' => 'Salida para técnico']);
        $repairing = State::create(['name' => 'Reparación']);
        $technician = User::factory()->create(['name' => 'Técnico receptor']);
        $local = $this->createLocal('Salón principal');
        $bar = $this->createBar('Bar principal');
        $localMachine = $this->createMachine('LOCAL-01', local: $local);
        $barMachine = $this->createMachine('BAR-01', bar: $bar);
        $sparePart = $this->createSparePart('Monedero físico', $workshop);
        $deliveryNote = app(DeliveryNoteWorkflow::class)->create([
            'spare_part_id' => $sparePart->id,
            'state_id' => $outForTechnician->id,
            'user_id' => $technician->id,
            'local_id' => $local->id,
            'bar_id' => null,
            'machine_id' => $localMachine->id,
            'comment' => null,
        ]);

        Livewire::test(EditDeliveryNote::class, ['record' => $deliveryNote->id])
            ->fillForm([
                'state_id' => $repairing->id,
                'local_id' => null,
                'bar_id' => $bar->id,
                'machine_id' => $barMachine->id,
                'comment' => 'Se envía a reparación',
            ])
            ->call('save')
            ->assertHasNoFormErrors()
            ->assertNotified();

        $this->assertDatabaseHas('delivery_notes', [
            'id' => $deliveryNote->id,
            'state_id' => $repairing->id,
            'local_id' => null,
            'bar_id' => $bar->id,
            'machine_id' => $barMachine->id,
        ]);
        $this->assertDatabaseHas('spare_parts', [
            'id' => $sparePart->id,
            'state_id' => $repairing->id,
        ]);

        Livewire::test(ListDeliveryNotes::class)
            ->callAction(
                TestAction::make('changeState')->table($deliveryNote->refresh()),
                ['state_id' => $workshop->id],
            )
            ->assertNotified();

        $this->assertDatabaseHas('delivery_notes', [
            'id' => $deliveryNote->id,
            'state_id' => $workshop->id,
        ]);
        $this->assertDatabaseHas('spare_parts', [
            'id' => $sparePart->id,
            'state_id' => $workshop->id,
        ]);
        $this->assertDatabaseHas('spare_part_state_histories', [
            'spare_part_id' => $sparePart->id,
            'previous_state_id' => $repairing->id,
            'new_state_id' => $workshop->id,
            'changed_by_user_id' => $this->admin->id,
        ]);
    }

    public function test_machine_must_belong_to_the_selected_location(): void
    {
        $state = State::create(['name' => 'Taller']);
        $technician = User::factory()->create(['name' => 'Técnico receptor']);
        $selectedLocal = $this->createLocal('Salón seleccionado');
        $otherLocal = $this->createLocal('Otro salón');
        $wrongMachine = $this->createMachine('OTRA-01', local: $otherLocal);
        $sparePart = $this->createSparePart('Monedero físico', $state);

        Livewire::test(CreateDeliveryNote::class)
            ->fillForm([
                'spare_part_id' => $sparePart->id,
                'state_id' => $state->id,
                'user_id' => $technician->id,
                'local_id' => $selectedLocal->id,
                'bar_id' => null,
                'machine_id' => $wrongMachine->id,
            ])
            ->call('create')
            ->assertHasFormErrors(['machine_id']);

        $this->assertDatabaseCount('delivery_notes', 0);
    }

    public function test_legacy_form_rejects_two_locations_and_the_history_is_read_only(): void
    {
        $state = State::create(['name' => 'Taller']);
        $technician = User::factory()->create(['name' => 'Técnico receptor']);
        $local = $this->createLocal('Salón principal');
        $bar = $this->createBar('Bar principal');
        $machine = $this->createMachine('LOCAL-01', local: $local);
        $sparePart = $this->createSparePart('Monedero físico', $state);

        $this->post(route('deliverynotes.store'), [
            'spare_part_id' => $sparePart->id,
            'state_id' => $state->id,
            'user_id' => $technician->id,
            'local_id' => $local->id,
            'bar_id' => $bar->id,
            'machine_id' => $machine->id,
        ])->assertSessionHasErrors(['local_id', 'bar_id', 'machine_id']);

        $history = $sparePart->stateHistories()->firstOrFail();

        $this->assertContains(StateHistoriesRelationManager::class, SparePartResource::getRelations());
        $this->assertTrue(Gate::allows('view', $history));
        $this->assertFalse(Gate::allows('create', SparePartStateHistory::class));
        $this->assertFalse(Gate::allows('update', $history));
        $this->assertFalse(Gate::allows('delete', $history));
    }

    public function test_resource_crud_and_legacy_blade_routes_coexist(): void
    {
        $state = State::create(['name' => 'Taller']);
        $technician = User::factory()->create(['name' => 'Técnico receptor']);
        $local = $this->createLocal('Salón principal');
        $machine = $this->createMachine('LOCAL-01', local: $local);
        $sparePart = $this->createSparePart('Monedero físico', $state);
        $deliveryNote = DeliveryNote::create([
            'spare_part_id' => $sparePart->id,
            'state_id' => $state->id,
            'user_id' => $technician->id,
            'local_id' => $local->id,
            'machine_id' => $machine->id,
        ]);

        $this->get(DeliveryNoteResource::getUrl('index'))->assertOk();
        $this->get(DeliveryNoteResource::getUrl('create'))->assertOk();
        $this->get(DeliveryNoteResource::getUrl('edit', ['record' => $deliveryNote]))->assertOk();
        $this->get(route('deliverynotes.index'))->assertOk();
        $this->get(route('deliverynotes.create'))->assertOk();
        $this->get(route('deliverynotes.edit', $deliveryNote))->assertOk();

        Livewire::test(ListDeliveryNotes::class)
            ->callAction(TestAction::make('delete')->table($deliveryNote))
            ->assertNotified();

        $this->assertDatabaseMissing('delivery_notes', ['id' => $deliveryNote->id]);
        $this->assertDatabaseHas('spare_parts', ['id' => $sparePart->id]);
    }

    private function createSparePart(string $name, State $state): SparePart
    {
        $suffix = Factory::query()->count() + 1;
        $factory = Factory::create([
            'name' => "Fabricante {$suffix}",
            'address' => "Calle de prueba, {$suffix}",
            'city' => 'Alicante',
            'email' => "fabricante{$suffix}@example.test",
            'cif' => 'B'.str_pad((string) $suffix, 8, '0', STR_PAD_LEFT),
        ]);

        return SparePart::create([
            'name' => $name,
            'factory_id' => $factory->id,
            'state_id' => $state->id,
        ]);
    }

    private function createLocal(string $name): Local
    {
        $suffix = Local::query()->count() + 1;

        return Local::create([
            'name' => $name,
            'dbconection' => ['host' => "192.0.2.{$suffix}"],
            'idMachines' => "LOCAL-{$suffix}",
        ]);
    }

    private function createBar(string $name): Bar
    {
        $suffix = Bar::query()->count() + 1;

        return Bar::create([
            'name' => $name,
            'holder' => "Titular {$suffix}",
            'dni_cif' => '1234567'.$suffix.'Z',
            'address' => "Calle Bar, {$suffix}",
            'town' => 'Alicante',
        ]);
    }

    private function createMachine(string $alias, ?Local $local = null, ?Bar $bar = null): Machine
    {
        return Machine::create([
            'name' => "Máquina {$alias}",
            'alias' => $alias,
            'identificador' => "ID-{$alias}",
            'type' => 'single',
            'local_id' => $local?->id,
            'bar_id' => $bar?->id,
        ]);
    }
}

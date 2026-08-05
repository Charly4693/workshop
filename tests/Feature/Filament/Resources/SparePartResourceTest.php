<?php

namespace Tests\Feature\Filament\Resources;

use App\Filament\Resources\SpareParts\Pages\CreateSparePart;
use App\Filament\Resources\SpareParts\Pages\EditSparePart;
use App\Filament\Resources\SpareParts\Pages\ListSpareParts;
use App\Filament\Resources\SpareParts\SparePartResource;
use App\Models\DeliveryNote;
use App\Models\Factory;
use App\Models\SparePart;
use App\Models\State;
use App\Models\User;
use Filament\Actions\Testing\TestAction;
use Filament\Facades\Filament;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Gate;
use Livewire\Livewire;
use Tests\TestCase;

class SparePartResourceTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();

        $this->actingAs(User::factory()->create());
        Filament::setCurrentPanel(Filament::getPanel('admin'));
    }

    public function test_spare_parts_can_be_listed_searched_filtered_and_sorted(): void
    {
        $available = State::create(['name' => 'Disponible']);
        $repairing = State::create(['name' => 'En reparación']);
        $northFactory = $this->createFactory('Fabricante Norte');
        $southFactory = $this->createFactory('Fabricante Sur');

        $older = $this->createSparePart('Motor antiguo', $northFactory, $repairing);
        $older->forceFill(['created_at' => now()->subDay()])->saveQuietly();
        $newer = $this->createSparePart('Placa nueva', $southFactory, $available);

        Livewire::test(ListSpareParts::class)
            ->assertSuccessful()
            ->assertCanSeeTableRecords([$older, $newer])
            ->searchTable('Fabricante Norte')
            ->assertCanSeeTableRecords([$older])
            ->assertCanNotSeeTableRecords([$newer]);

        Livewire::test(ListSpareParts::class)
            ->filterTable('factory_id', $southFactory->id)
            ->assertCanSeeTableRecords([$newer])
            ->assertCanNotSeeTableRecords([$older]);

        Livewire::test(ListSpareParts::class)
            ->filterTable('state_id', $repairing->id)
            ->assertCanSeeTableRecords([$older])
            ->assertCanNotSeeTableRecords([$newer]);

        Livewire::test(ListSpareParts::class)
            ->sortTable('created_at', 'desc')
            ->assertCanSeeTableRecords([$newer, $older], inOrder: true);
    }

    public function test_spare_parts_can_be_created_and_edited_with_shared_validation_rules(): void
    {
        $available = State::create(['name' => 'Disponible']);
        $repairing = State::create(['name' => 'En reparación']);
        $factory = $this->createFactory('Fabricante principal');

        Livewire::test(CreateSparePart::class)
            ->fillForm([
                'name' => 'Fuente de alimentación',
                'factory_id' => $factory->id,
                'state_id' => $available->id,
            ])
            ->call('create')
            ->assertHasNoFormErrors()
            ->assertNotified();

        $sparePart = SparePart::where('name', 'Fuente de alimentación')->firstOrFail();

        Livewire::test(EditSparePart::class, ['record' => $sparePart->id])
            ->fillForm([
                'name' => 'Fuente actualizada',
                'state_id' => $repairing->id,
            ])
            ->call('save')
            ->assertHasNoFormErrors()
            ->assertNotified();

        $this->assertDatabaseHas('spare_parts', [
            'id' => $sparePart->id,
            'name' => 'Fuente actualizada',
            'factory_id' => $factory->id,
            'state_id' => $repairing->id,
        ]);
    }

    public function test_spare_part_form_rejects_missing_and_invalid_data(): void
    {
        Livewire::test(CreateSparePart::class)
            ->fillForm([
                'name' => '',
                'factory_id' => 999999,
                'state_id' => 999999,
            ])
            ->call('create')
            ->assertHasFormErrors([
                'name' => 'required',
                'factory_id',
                'state_id',
            ]);

        $this->assertDatabaseCount('spare_parts', 0);
    }

    public function test_individual_and_bulk_deletion_are_safe_for_delivery_notes(): void
    {
        $state = State::create(['name' => 'Disponible']);
        $factory = $this->createFactory('Fabricante principal');
        $withDeliveryNote = $this->createSparePart('Pieza con albarán', $factory, $state);
        $bulkOne = $this->createSparePart('Pieza masiva uno', $factory, $state);
        $bulkTwo = $this->createSparePart('Pieza masiva dos', $factory, $state);
        $deliveryNote = DeliveryNote::create([
            'spare_part_id' => $withDeliveryNote->id,
            'comment' => 'Debe conservarse al eliminar el repuesto',
        ]);

        Livewire::test(ListSpareParts::class)
            ->callAction(TestAction::make('delete')->table($withDeliveryNote))
            ->assertNotified();

        $this->assertDatabaseMissing('spare_parts', ['id' => $withDeliveryNote->id]);
        $this->assertDatabaseHas('delivery_notes', [
            'id' => $deliveryNote->id,
            'spare_part_id' => null,
        ]);

        Livewire::test(ListSpareParts::class)
            ->selectTableRecords([$bulkOne, $bulkTwo])
            ->callAction(TestAction::make('delete')->table()->bulk())
            ->assertNotified();

        $this->assertDatabaseMissing('spare_parts', ['id' => $bulkOne->id]);
        $this->assertDatabaseMissing('spare_parts', ['id' => $bulkTwo->id]);
    }

    public function test_filament_resource_and_legacy_blade_routes_coexist_and_require_authentication(): void
    {
        $state = State::create(['name' => 'Disponible']);
        $factory = $this->createFactory('Fabricante principal');
        $sparePart = $this->createSparePart('Placa de control', $factory, $state);

        $this->assertTrue(Gate::allows('viewAny', SparePart::class));
        $this->assertTrue(Gate::allows('create', SparePart::class));
        $this->assertTrue(Gate::allows('update', $sparePart));
        $this->assertTrue(Gate::allows('delete', $sparePart));
        $this->assertTrue(Gate::allows('deleteAny', SparePart::class));

        $this->get(SparePartResource::getUrl('index'))->assertOk();
        $this->get(SparePartResource::getUrl('create'))->assertOk();
        $this->get(SparePartResource::getUrl('edit', ['record' => $sparePart]))->assertOk();
        $this->get(route('spareparts.index'))->assertOk();
        $this->get(route('spareparts.create'))->assertOk();
        $this->get(route('spareparts.edit', $sparePart))->assertOk();

        auth()->logout();

        $this->get(SparePartResource::getUrl('index'))->assertRedirect();
        $this->get(route('spareparts.index'))->assertRedirect('/login');
    }

    private function createFactory(string $name): Factory
    {
        $suffix = Factory::query()->count() + 1;

        return Factory::create([
            'name' => $name,
            'address' => "Calle de prueba, {$suffix}",
            'city' => 'Alicante',
            'phone' => '600000000',
            'email' => "fabricante{$suffix}@example.test",
            'cif' => 'B'.str_pad((string) $suffix, 8, '0', STR_PAD_LEFT),
        ]);
    }

    private function createSparePart(
        string $name,
        Factory $factory,
        State $state,
    ): SparePart {
        return SparePart::create([
            'name' => $name,
            'factory_id' => $factory->id,
            'state_id' => $state->id,
        ]);
    }
}

<?php

namespace Tests\Feature\Filament\Resources;

use App\Filament\Resources\Factories\FactoryResource;
use App\Filament\Resources\Factories\Pages\CreateFactory;
use App\Filament\Resources\Factories\Pages\EditFactory;
use App\Filament\Resources\Factories\Pages\ListFactories;
use App\Filament\Resources\Factories\RelationManagers\SparePartsRelationManager;
use App\Filament\Resources\States\Pages\ManageStates;
use App\Filament\Resources\States\StateResource;
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

class PilotResourcesTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();

        $this->actingAs(User::factory()->create());
        Filament::setCurrentPanel(Filament::getPanel('admin'));
    }

    public function test_states_can_be_listed_searched_created_and_edited_in_modals(): void
    {
        $repairing = State::create(['name' => 'Reparación']);
        $finished = State::create(['name' => 'Finalizado']);

        Livewire::test(ManageStates::class)
            ->assertSuccessful()
            ->assertCanSeeTableRecords([$repairing, $finished])
            ->searchTable('Reparación')
            ->assertCanSeeTableRecords([$repairing])
            ->assertCanNotSeeTableRecords([$finished])
            ->callAction('create', ['name' => 'Pendiente'])
            ->assertHasNoFormErrors()
            ->assertNotified();

        $pending = State::where('name', 'Pendiente')->firstOrFail();

        Livewire::test(ManageStates::class)
            ->callAction(
                TestAction::make('edit')->table($pending),
                ['name' => 'Pendiente de pieza'],
            )
            ->assertHasNoFormErrors()
            ->assertNotified();

        $this->assertDatabaseHas('states', [
            'id' => $pending->id,
            'name' => 'Pendiente de pieza',
        ]);
    }

    public function test_state_names_must_be_unique(): void
    {
        State::create(['name' => 'Reparación']);

        Livewire::test(ManageStates::class)
            ->callAction('create', ['name' => 'Reparación'])
            ->assertHasFormErrors(['name' => 'unique'])
            ->assertNotNotified();

        $this->assertDatabaseCount('states', 1);
    }

    public function test_used_states_show_relation_counts_and_cannot_be_deleted(): void
    {
        $state = State::create(['name' => 'En uso']);
        $unusedState = State::create(['name' => 'Sin uso']);
        $factory = $this->createFactory();

        SparePart::create([
            'name' => 'Placa de control',
            'factory_id' => $factory->id,
            'state_id' => $state->id,
        ]);
        DeliveryNote::create([
            'state_id' => $state->id,
            'comment' => 'Albarán de prueba',
        ]);

        $this->assertFalse(Gate::allows('delete', $state));

        Livewire::test(ManageStates::class)
            ->assertTableColumnStateSet('spare_parts_count', 1, $state)
            ->assertTableColumnStateSet('delivery_notes_count', 1, $state)
            ->assertActionHidden(TestAction::make('delete')->table($state))
            ->callAction(TestAction::make('delete')->table($unusedState))
            ->assertNotified();

        $this->assertDatabaseHas('states', ['id' => $state->id]);
        $this->assertDatabaseMissing('states', ['id' => $unusedState->id]);
    }

    public function test_factories_can_be_listed_searched_and_filtered_by_city(): void
    {
        $alicante = $this->createFactory([
            'name' => 'Fabricante Alicante',
            'city' => 'Alicante',
            'email' => 'alicante@example.test',
            'cif' => 'B10000011',
        ]);
        $valencia = $this->createFactory([
            'name' => 'Fabricante Valencia',
            'city' => 'Valencia',
            'email' => 'valencia@example.test',
            'cif' => 'B10000012',
        ]);

        Livewire::test(ListFactories::class)
            ->assertSuccessful()
            ->assertCanSeeTableRecords([$alicante, $valencia])
            ->searchTable('B10000011')
            ->assertCanSeeTableRecords([$alicante])
            ->assertCanNotSeeTableRecords([$valencia]);

        Livewire::test(ListFactories::class)
            ->filterTable('city', 'Valencia')
            ->assertCanSeeTableRecords([$valencia])
            ->assertCanNotSeeTableRecords([$alicante]);
    }

    public function test_factories_can_be_created_and_edited_with_shared_validation_rules(): void
    {
        Livewire::test(CreateFactory::class)
            ->fillForm($this->factoryData())
            ->call('create')
            ->assertHasNoFormErrors()
            ->assertNotified();

        $factory = Factory::where('email', 'fabricante@example.test')->firstOrFail();

        Livewire::test(EditFactory::class, ['record' => $factory->id])
            ->fillForm(['name' => 'Fabricante actualizado'])
            ->call('save')
            ->assertHasNoFormErrors()
            ->assertNotified();

        $this->assertDatabaseHas('factories', [
            'id' => $factory->id,
            'name' => 'Fabricante actualizado',
            'email' => 'fabricante@example.test',
            'cif' => 'B10000001',
        ]);
    }

    public function test_factory_email_and_cif_must_be_valid_and_unique(): void
    {
        $existing = $this->createFactory();

        Livewire::test(CreateFactory::class)
            ->fillForm($this->factoryData([
                'email' => $existing->email,
                'cif' => $existing->cif,
            ]))
            ->call('create')
            ->assertHasFormErrors([
                'email' => 'unique',
                'cif' => 'unique',
            ]);

        Livewire::test(CreateFactory::class)
            ->fillForm($this->factoryData([
                'email' => 'correo-no-valido',
                'cif' => '',
            ]))
            ->call('create')
            ->assertHasFormErrors([
                'email' => 'email',
                'cif' => 'required',
            ]);
    }

    public function test_used_factories_cannot_be_deleted_and_expose_the_spare_parts_relation(): void
    {
        $state = State::create(['name' => 'Disponible']);
        $usedFactory = $this->createFactory();
        $unusedFactory = $this->createFactory([
            'email' => 'sin-repuestos@example.test',
            'cif' => 'B10000002',
        ]);

        SparePart::create([
            'name' => 'Fuente de alimentación',
            'factory_id' => $usedFactory->id,
            'state_id' => $state->id,
        ]);

        $this->assertContains(SparePartsRelationManager::class, FactoryResource::getRelations());
        $this->assertFalse(Gate::allows('delete', $usedFactory));
        $this->assertTrue(Gate::allows('delete', $unusedFactory));

        Livewire::test(ListFactories::class)
            ->assertTableColumnStateSet('spare_parts_count', 1, $usedFactory)
            ->assertActionHidden(TestAction::make('delete')->table($usedFactory))
            ->callAction(TestAction::make('delete')->table($unusedFactory))
            ->assertNotified();

        $this->assertDatabaseHas('factories', ['id' => $usedFactory->id]);
        $this->assertDatabaseMissing('factories', ['id' => $unusedFactory->id]);
    }

    public function test_resource_pages_are_registered_in_the_admin_panel(): void
    {
        $factory = $this->createFactory();

        $this->get(StateResource::getUrl('index'))->assertOk();
        $this->get(FactoryResource::getUrl('index'))->assertOk();
        $this->get(FactoryResource::getUrl('create'))->assertOk();
        $this->get(FactoryResource::getUrl('edit', ['record' => $factory]))->assertOk();
    }

    private function createFactory(array $attributes = []): Factory
    {
        return Factory::create($this->factoryData($attributes));
    }

    private function factoryData(array $attributes = []): array
    {
        return array_merge([
            'name' => 'Fabricante de prueba',
            'address' => 'Calle de prueba, 1',
            'city' => 'Alicante',
            'phone' => '600000000',
            'email' => 'fabricante@example.test',
            'cif' => 'B10000001',
        ], $attributes);
    }
}

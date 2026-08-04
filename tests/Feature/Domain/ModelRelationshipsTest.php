<?php

namespace Tests\Feature\Domain;

use App\Models\Bar;
use App\Models\DeliveryNote;
use App\Models\Factory;
use App\Models\Local;
use App\Models\Machine;
use App\Models\SparePart;
use App\Models\State;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Validation\ValidationException;
use Tests\TestCase;

class ModelRelationshipsTest extends TestCase
{
    use RefreshDatabase;

    public function test_workshop_models_expose_the_required_inverse_relationships(): void
    {
        $factory = Factory::create($this->factoryData());
        $state = State::create(['name' => 'En taller']);
        $local = Local::create([
            'name' => 'Local de prueba',
            'dbconection' => [],
            'idMachines' => 'TEST-001',
        ]);
        $sparePart = SparePart::create([
            'name' => 'Repuesto de prueba',
            'factory_id' => $factory->id,
            'state_id' => $state->id,
        ]);
        $machine = Machine::create([
            'name' => 'Máquina de prueba',
            'alias' => 'TEST',
            'identificador' => 'TEST-MACHINE-001',
            'type' => 'single',
            'local_id' => $local->id,
        ]);
        $deliveryNote = DeliveryNote::create([
            'spare_part_id' => $sparePart->id,
            'state_id' => $state->id,
            'local_id' => $local->id,
            'machine_id' => $machine->id,
        ]);

        $this->assertTrue($factory->spareParts->contains($sparePart));
        $this->assertTrue($state->spareParts->contains($sparePart));
        $this->assertTrue($state->deliveryNotes->contains($deliveryNote));
        $this->assertTrue($local->machines->contains($machine));
        $this->assertTrue($local->deliveryNotes->contains($deliveryNote));
        $this->assertTrue($machine->deliveryNotes->contains($deliveryNote));
        $this->assertTrue($sparePart->deliveryNotes->contains($deliveryNote));
    }

    public function test_a_machine_must_belong_to_exactly_one_location(): void
    {
        $local = Local::create([
            'name' => 'Local de prueba',
            'dbconection' => [],
            'idMachines' => 'TEST-002',
        ]);
        $bar = Bar::create($this->barData());

        $this->expectException(ValidationException::class);

        Machine::create([
            'name' => 'Máquina inválida',
            'alias' => 'INVALID',
            'identificador' => 'TEST-MACHINE-002',
            'type' => 'single',
            'local_id' => $local->id,
            'bar_id' => $bar->id,
        ]);
    }

    public function test_a_child_machine_must_share_its_parent_location(): void
    {
        $firstLocal = Local::create([
            'name' => 'Local uno',
            'dbconection' => [],
            'idMachines' => 'TEST-003',
        ]);
        $secondLocal = Local::create([
            'name' => 'Local dos',
            'dbconection' => [],
            'idMachines' => 'TEST-004',
        ]);
        $parent = Machine::create([
            'name' => 'Máquina padre',
            'alias' => 'PARENT',
            'identificador' => 'TEST-MACHINE-003',
            'type' => 'parent',
            'local_id' => $firstLocal->id,
        ]);

        $this->expectException(ValidationException::class);

        Machine::create([
            'name' => 'Máquina hija',
            'alias' => 'CHILD',
            'identificador' => 'TEST-MACHINE-004',
            'type' => 'single',
            'local_id' => $secondLocal->id,
            'parent_id' => $parent->id,
        ]);
    }

    public function test_deleting_a_related_record_preserves_the_delivery_note(): void
    {
        $state = State::create(['name' => 'Estado temporal']);
        $deliveryNote = DeliveryNote::create(['state_id' => $state->id]);

        $state->delete();

        $this->assertDatabaseHas('delivery_notes', [
            'id' => $deliveryNote->id,
            'state_id' => null,
        ]);
    }

    private function factoryData(): array
    {
        return [
            'name' => 'Fabricante de prueba',
            'address' => 'Calle de prueba, 1',
            'city' => 'Pruebas',
            'phone' => null,
            'email' => 'factory@example.test',
            'cif' => 'B00000001',
        ];
    }

    private function barData(): array
    {
        return [
            'name' => 'Bar de prueba',
            'holder' => 'Empresa de prueba, S.L.',
            'dni_cif' => 'B00000002',
            'address' => 'Calle de prueba, 2',
            'town' => 'Pruebas',
        ];
    }
}

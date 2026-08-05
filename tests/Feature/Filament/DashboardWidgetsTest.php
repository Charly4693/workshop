<?php

namespace Tests\Feature\Filament;

use App\Filament\Widgets\DeliveryNotesByState;
use App\Filament\Widgets\LatestDeliveryNotes;
use App\Filament\Widgets\RecentStateChanges;
use App\Filament\Widgets\SparePartsByState;
use App\Models\DeliveryNote;
use App\Models\Factory;
use App\Models\SparePart;
use App\Models\SparePartStateHistory;
use App\Models\State;
use App\Models\User;
use Filament\Facades\Filament;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Livewire\Livewire;
use Tests\TestCase;

class DashboardWidgetsTest extends TestCase
{
    use RefreshDatabase;

    private User $admin;

    protected function setUp(): void
    {
        parent::setUp();

        $this->admin = User::factory()->create();
        $this->actingAs($this->admin);
        Filament::setCurrentPanel(Filament::getPanel('admin'));
    }

    public function test_the_dashboard_registers_the_four_requested_widgets(): void
    {
        $widgets = Filament::getPanel('admin')->getWidgets();

        $this->assertContains(LatestDeliveryNotes::class, $widgets);
        $this->assertContains(DeliveryNotesByState::class, $widgets);
        $this->assertContains(SparePartsByState::class, $widgets);
        $this->assertContains(RecentStateChanges::class, $widgets);

        $this->get('/admin')->assertOk();

        Livewire::test(LatestDeliveryNotes::class)->assertSee('Últimos 10 albaranes');
        Livewire::test(DeliveryNotesByState::class)->assertSee('Albaranes por estado');
        Livewire::test(SparePartsByState::class)->assertSee('Repuestos por estado');
        Livewire::test(RecentStateChanges::class)->assertSee('Actividad reciente');
    }

    public function test_state_widgets_group_delivery_notes_and_spare_parts(): void
    {
        $workshop = State::create(['name' => 'Taller']);
        $repairing = State::create(['name' => 'Reparación']);
        $factory = $this->createFactory();
        $workshopParts = collect(range(1, 3))->map(fn (int $index): SparePart => SparePart::create([
            'name' => "Repuesto taller {$index}",
            'factory_id' => $factory->id,
            'state_id' => $workshop->id,
        ]));
        $repairingParts = collect(range(1, 2))->map(fn (int $index): SparePart => SparePart::create([
            'name' => "Repuesto reparación {$index}",
            'factory_id' => $factory->id,
            'state_id' => $repairing->id,
        ]));

        foreach (range(1, 4) as $index) {
            DeliveryNote::create([
                'spare_part_id' => $workshopParts->first()->id,
                'state_id' => $workshop->id,
                'user_id' => $this->admin->id,
                'comment' => "Albarán de taller {$index}",
            ]);
        }

        foreach (range(1, 3) as $index) {
            DeliveryNote::create([
                'spare_part_id' => $repairingParts->first()->id,
                'state_id' => $repairing->id,
                'user_id' => $this->admin->id,
                'comment' => "Albarán de reparación {$index}",
            ]);
        }

        DeliveryNote::create([
            'spare_part_id' => $workshopParts->first()->id,
            'state_id' => null,
            'user_id' => $this->admin->id,
            'comment' => 'Albarán sin estado',
        ]);

        $deliveryNoteCounts = Livewire::test(DeliveryNotesByState::class)
            ->instance()
            ->getStateCounts();
        $sparePartCounts = Livewire::test(SparePartsByState::class)
            ->instance()
            ->getStateCounts();

        $this->assertSame(['Reparación' => 3, 'Taller' => 4, 'Sin estado' => 1], $deliveryNoteCounts);
        $this->assertSame(['Reparación' => 2, 'Taller' => 3], $sparePartCounts);
    }

    public function test_recent_tables_are_limited_to_the_latest_ten_records(): void
    {
        $workshop = State::create(['name' => 'Taller']);
        $repairing = State::create(['name' => 'Reparación']);
        $factory = $this->createFactory();
        $sparePart = SparePart::create([
            'name' => 'Monedero de prueba',
            'factory_id' => $factory->id,
            'state_id' => $workshop->id,
        ]);
        $sparePart->stateHistories()->firstOrFail()
            ->forceFill(['created_at' => now()->subHour()])
            ->saveQuietly();

        $deliveryNotes = collect(range(1, 12))->map(function (int $index) use ($sparePart, $workshop): DeliveryNote {
            $deliveryNote = DeliveryNote::create([
                'spare_part_id' => $sparePart->id,
                'state_id' => $workshop->id,
                'user_id' => $this->admin->id,
                'comment' => "Albarán {$index}",
            ]);
            $deliveryNote->forceFill(['created_at' => now()->subMinutes(13 - $index)])->saveQuietly();

            return $deliveryNote;
        });

        $histories = collect(range(1, 12))->map(function (int $index) use ($sparePart, $workshop, $repairing): SparePartStateHistory {
            $history = SparePartStateHistory::create([
                'spare_part_id' => $sparePart->id,
                'previous_state_id' => $index % 2 === 0 ? $workshop->id : $repairing->id,
                'new_state_id' => $index % 2 === 0 ? $repairing->id : $workshop->id,
                'changed_by_user_id' => $this->admin->id,
            ]);
            $history->forceFill(['created_at' => now()->subMinutes(13 - $index)])->saveQuietly();

            return $history;
        });

        $latestDeliveryNotes = $deliveryNotes->reverse()->take(10)->values()->all();
        $oldestDeliveryNotes = $deliveryNotes->take(2)->all();
        $latestHistories = $histories->reverse()->take(10)->values()->all();
        $oldestHistories = $histories->take(2)->all();

        Livewire::test(LatestDeliveryNotes::class)
            ->assertCanSeeTableRecords($latestDeliveryNotes)
            ->assertCanNotSeeTableRecords($oldestDeliveryNotes);

        Livewire::test(RecentStateChanges::class)
            ->assertCanSeeTableRecords($latestHistories)
            ->assertCanNotSeeTableRecords($oldestHistories);
    }

    private function createFactory(): Factory
    {
        return Factory::create([
            'name' => 'Fabricante dashboard',
            'address' => 'Calle de prueba, 1',
            'city' => 'Alicante',
            'email' => 'dashboard@example.test',
            'cif' => 'B12345678',
        ]);
    }
}

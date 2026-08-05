<?php

namespace App\Filament\Widgets;

use App\Models\DeliveryNote;
use App\Models\SparePart;
use App\Models\State;
use Filament\Widgets\Widget;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Collection;
use Livewire\Attributes\Computed;
use Livewire\WithPagination;

class StateCatalogLists extends Widget
{
    use WithPagination;

    protected static ?int $sort = 20;

    protected int|string|array $columnSpan = 'full';

    protected string $view = 'filament.widgets.state-catalog-lists';

    public ?int $activeStateId = null;

    public function mount(): void
    {
        $this->activeStateId = State::query()->orderBy('name')->value('id');
    }

    public function selectState(int $stateId): void
    {
        if (! State::query()->whereKey($stateId)->exists()) {
            return;
        }

        $this->activeStateId = $stateId;
        $this->resetPage('deliveryNotesPage');
        $this->resetPage('sparePartsPage');
        unset($this->deliveryNotes, $this->spareParts);
    }

    #[Computed]
    public function states(): Collection
    {
        return State::query()
            ->withCount(['deliveryNotes', 'spareParts'])
            ->orderBy('name')
            ->get();
    }

    #[Computed]
    public function deliveryNotes(): LengthAwarePaginator
    {
        return DeliveryNote::query()
            ->with([
                'sparepart:id,name',
                'user:id,name',
                'local:id,name',
                'bar:id,name',
                'machine:id,alias',
            ])
            ->when(
                $this->activeStateId !== null,
                fn (Builder $query): Builder => $query->where('state_id', $this->activeStateId),
                fn (Builder $query): Builder => $query->whereRaw('1 = 0'),
            )
            ->latest('created_at')
            ->latest('id')
            ->paginate(10, pageName: 'deliveryNotesPage');
    }

    #[Computed]
    public function spareParts(): LengthAwarePaginator
    {
        return SparePart::query()
            ->with('factory:id,name')
            ->when(
                $this->activeStateId !== null,
                fn (Builder $query): Builder => $query->where('state_id', $this->activeStateId),
                fn (Builder $query): Builder => $query->whereRaw('1 = 0'),
            )
            ->latest('updated_at')
            ->latest('id')
            ->paginate(10, pageName: 'sparePartsPage');
    }
}

<?php

namespace App\Filament\Widgets;

use App\Models\DeliveryNote;
use App\Models\State;
use Filament\Widgets\Widget;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Collection;
use Livewire\Attributes\Computed;
use Livewire\WithPagination;

class DeliveryNotesByState extends Widget
{
    use WithPagination;

    protected static ?int $sort = 20;

    protected int|string|array $columnSpan = 'full';

    protected string $view = 'filament.widgets.delivery-notes-by-state';

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
        unset($this->deliveryNotes);
    }

    #[Computed]
    public function states(): Collection
    {
        return State::query()
            ->withCount('deliveryNotes')
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
            ->paginate(5, pageName: 'deliveryNotesPage');
    }
}

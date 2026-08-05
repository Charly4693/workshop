<?php

namespace App\Observers;

use App\Models\SparePart;
use Illuminate\Support\Facades\Auth;

class SparePartObserver
{
    public function created(SparePart $sparePart): void
    {
        $this->recordTransition($sparePart, null, $sparePart->state_id);
    }

    public function updated(SparePart $sparePart): void
    {
        if (! $sparePart->wasChanged('state_id')) {
            return;
        }

        $this->recordTransition(
            $sparePart,
            $sparePart->getOriginal('state_id'),
            $sparePart->state_id,
        );
    }

    private function recordTransition(
        SparePart $sparePart,
        int|string|null $previousStateId,
        int|string|null $newStateId,
    ): void {
        if ($newStateId === null || (string) $previousStateId === (string) $newStateId) {
            return;
        }

        $sparePart->stateHistories()->create([
            'previous_state_id' => $previousStateId,
            'new_state_id' => $newStateId,
            'changed_by_user_id' => Auth::id(),
        ]);
    }
}

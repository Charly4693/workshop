<?php

namespace App\Services;

use App\Models\DeliveryNote;
use App\Models\SparePart;
use Illuminate\Support\Facades\DB;

final class DeliveryNoteWorkflow
{
    public function create(array $data): DeliveryNote
    {
        return DB::transaction(function () use ($data): DeliveryNote {
            $deliveryNote = DeliveryNote::create($data);

            $this->synchronizeSparePartState($deliveryNote);

            return $deliveryNote;
        });
    }

    public function update(DeliveryNote $deliveryNote, array $data): DeliveryNote
    {
        return DB::transaction(function () use ($deliveryNote, $data): DeliveryNote {
            $deliveryNote->update($data);

            $this->synchronizeSparePartState($deliveryNote);

            return $deliveryNote->refresh();
        });
    }

    private function synchronizeSparePartState(DeliveryNote $deliveryNote): void
    {
        if ($deliveryNote->spare_part_id === null || $deliveryNote->state_id === null) {
            return;
        }

        $sparePart = SparePart::query()
            ->lockForUpdate()
            ->findOrFail($deliveryNote->spare_part_id);

        if ($sparePart->state_id === $deliveryNote->state_id) {
            return;
        }

        $sparePart->update(['state_id' => $deliveryNote->state_id]);
    }
}

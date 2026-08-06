<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class State extends Model
{
    protected $fillable = [
        'name',
    ];

    public function spareParts(): HasMany
    {
        return $this->hasMany(SparePart::class, 'state_id');
    }

    public function deliveryNotes(): HasMany
    {
        return $this->hasMany(DeliveryNote::class);
    }

    public function previousSparePartStateHistories(): HasMany
    {
        return $this->hasMany(SparePartStateHistory::class, 'previous_state_id');
    }

    public function newSparePartStateHistories(): HasMany
    {
        return $this->hasMany(SparePartStateHistory::class, 'new_state_id');
    }

    public function isInUse(): bool
    {
        return $this->spareParts()->exists()
            || $this->deliveryNotes()->exists()
            || $this->previousSparePartStateHistories()->exists()
            || $this->newSparePartStateHistories()->exists();
    }
}

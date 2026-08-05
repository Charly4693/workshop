<?php

namespace App\Models;

use App\Observers\SparePartObserver;
use Illuminate\Database\Eloquent\Attributes\ObservedBy;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

#[ObservedBy([SparePartObserver::class])]
class SparePart extends Model
{
    protected $fillable = [
        'name',
        'factory_id',
        'state_id',
    ];

    public function factory(): BelongsTo
    {
        return $this->belongsTo(Factory::class, 'factory_id');
    }

    public function state(): BelongsTo
    {
        return $this->belongsTo(State::class, 'state_id');
    }

    public function deliveryNotes(): HasMany
    {
        return $this->hasMany(DeliveryNote::class, 'spare_part_id');
    }

    public function latestDeliveryNote(): HasOne
    {
        return $this->hasOne(DeliveryNote::class, 'spare_part_id')->latestOfMany();
    }

    public function stateHistories(): HasMany
    {
        return $this->hasMany(SparePartStateHistory::class);
    }
}

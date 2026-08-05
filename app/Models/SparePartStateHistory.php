<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class SparePartStateHistory extends Model
{
    protected $fillable = [
        'spare_part_id',
        'previous_state_id',
        'new_state_id',
        'changed_by_user_id',
    ];

    public function sparePart(): BelongsTo
    {
        return $this->belongsTo(SparePart::class);
    }

    public function previousState(): BelongsTo
    {
        return $this->belongsTo(State::class, 'previous_state_id');
    }

    public function newState(): BelongsTo
    {
        return $this->belongsTo(State::class, 'new_state_id');
    }

    public function changedBy(): BelongsTo
    {
        return $this->belongsTo(User::class, 'changed_by_user_id');
    }
}

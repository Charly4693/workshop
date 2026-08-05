<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Local extends Model
{
    protected $fillable = [
        'name',
        'dbconection',
        'idMachines',
        'is_active',
        'synced_at',
    ];

    protected $casts = [
        'dbconection' => 'array',
        'is_active' => 'boolean',
        'synced_at' => 'datetime',
    ];

    protected $hidden = [
        'dbconection',
    ];

    public function machines(): HasMany
    {
        return $this->hasMany(Machine::class);
    }

    public function deliveryNotes(): HasMany
    {
        return $this->hasMany(DeliveryNote::class);
    }
}

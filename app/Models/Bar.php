<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Bar extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'holder',
        'dni_cif',
        'address',
        'town',
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

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Factory extends Model
{
    //
    protected $fillable = [
        'name',
        'address',
        'phone',
        'city',
        'email',
        'cif',
    ];

    public function spareParts(): HasMany
    {
        return $this->hasMany(SparePart::class, 'factory_id');
    }
}

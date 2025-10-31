<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Factory extends Model
{
    //
    protected $fillable = [
        'name',
        'address',
        'telephone',
        'city'
    ];

    public function locals()
    {
        return $this->hasMany(Local::class, 'factory_id');
    }

    public function spare_parts()
    {
        return $this->hasMany(SparePart::class, 'factory_id');
    }
}

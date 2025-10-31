<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SparePart extends Model
{
    protected $fillable = [
        'name',
        'factory_id',
        'state_id', // <- corregido
    ];

    public function factory()
    {
        return $this->belongsTo(Factory::class, 'factory_id');
    }
    public function state()
    {
        return $this->belongsTo(State::class, 'state_id');
    }
}

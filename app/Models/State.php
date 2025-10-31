<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class State extends Model
{
    protected $fillable = [
        'name',
    ];

    public function spareParts()
    {
        return $this->hasMany(SparePart::class, 'state_id');
    }
}

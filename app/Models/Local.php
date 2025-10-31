<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Local extends Model
{
    protected $fillable = [
        'factory_id',   // <- añadir
        'name',
        'dbconection',
        'idMachines',
    ];

    protected $casts = [
        'dbconection' => 'array',
    ];

    public function factory()
    {
        return $this->belongsTo(Factory::class, 'factory_id');
    }
    public function machines()
    {
        return $this->hasMany(Machine::class);
    }
}

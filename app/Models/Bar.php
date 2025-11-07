<?php

namespace App\Models;

use App\Models\Machine;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bar extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
    ];

    public function machines()
    {
        return $this->hasMany(Machine::class);
    }
}

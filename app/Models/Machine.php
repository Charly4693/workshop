<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Machine extends Model
{
    //
    protected $fillable = [
        'name',
        'alias',
        'local_id',
        'identificador',
        'type',
        'parent_id'
    ];

    public function local()
    {
        return $this->belongsTo(Local::class);
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DeliveryNote extends Model
{
    protected $fillable = [
        'spare_part_id', // <- singular
        'state_id',      // <- singular
        'local_id',
        'machine_id',
        'user_id',
        'comment'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function sparePart()
    {
        return $this->belongsTo(SparePart::class, 'spare_part_id');
    }
    public function state()
    {
        return $this->belongsTo(State::class, 'state_id');
    }
    public function local()
    {
        return $this->belongsTo(Local::class, 'local_id');
    }

    public function bar()
    {
        return $this->belongsTo(Bar::class, 'bar_id');
    }
}

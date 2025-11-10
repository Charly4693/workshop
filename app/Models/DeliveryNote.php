<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DeliveryNote extends Model
{
    protected $fillable = [
        'spare_part_id',
        'state_id',
        'local_id',
        'bar_id',
        'machine_id',
        'user_id',
        'comment',
    ];

    public function sparepart()
    {
        return $this->belongsTo(SparePart::class, 'spare_part_id');
    }
    public function state()
    {
        return $this->belongsTo(State::class);
    }
    public function local()
    {
        return $this->belongsTo(Local::class);
    }
    public function bar()
    {
        return $this->belongsTo(Bar::class);
    }
    public function machine()
    {
        return $this->belongsTo(Machine::class);
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}

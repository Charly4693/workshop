<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Validation\ValidationException;

class Machine extends Model
{
    //
    protected $fillable = [
        'name',
        'alias',
        'local_id',
        'bar_id',
        'identificador',
        'type',
        'parent_id',
    ];

    protected static function booted(): void
    {
        static::saving(function (Machine $machine): void {
            $hasLocal = $machine->local_id !== null;
            $hasBar = $machine->bar_id !== null;

            if ($hasLocal === $hasBar) {
                throw ValidationException::withMessages([
                    'local_id' => 'La máquina debe pertenecer a un local o a un bar, pero no a ambos.',
                    'bar_id' => 'La máquina debe pertenecer a un local o a un bar, pero no a ambos.',
                ]);
            }

            if ($machine->parent_id === null) {
                return;
            }

            if ($machine->exists && $machine->parent_id === $machine->getKey()) {
                throw ValidationException::withMessages([
                    'parent_id' => 'Una máquina no puede ser su propia máquina padre.',
                ]);
            }

            $parent = static::query()->find($machine->parent_id);

            if ($parent === null) {
                throw ValidationException::withMessages([
                    'parent_id' => 'La máquina padre seleccionada no existe.',
                ]);
            }

            if ($parent->local_id !== $machine->local_id || $parent->bar_id !== $machine->bar_id) {
                throw ValidationException::withMessages([
                    'parent_id' => 'La máquina padre debe pertenecer a la misma ubicación.',
                ]);
            }

            $ancestor = $parent;

            while ($ancestor !== null) {
                if ($machine->exists && $ancestor->getKey() === $machine->getKey()) {
                    throw ValidationException::withMessages([
                        'parent_id' => 'La relación seleccionada crearía un ciclo entre máquinas.',
                    ]);
                }

                $ancestor = $ancestor->parent;
            }
        });
    }

    public function local(): BelongsTo
    {
        return $this->belongsTo(Local::class);
    }

    public function bar(): BelongsTo
    {
        return $this->belongsTo(Bar::class);
    }

    public function parent(): BelongsTo
    {
        return $this->belongsTo(self::class, 'parent_id');
    }

    public function children(): HasMany
    {
        return $this->hasMany(self::class, 'parent_id');
    }

    public function deliveryNotes(): HasMany
    {
        return $this->hasMany(DeliveryNote::class);
    }
}

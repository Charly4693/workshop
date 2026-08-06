<?php

namespace App\Policies;

use App\Models\State;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;

class StatePolicy extends AuthenticatedUserPolicy
{
    public function delete(User $user, Model $record): bool
    {
        return $record instanceof State && ! $record->isInUse();
    }

    public function deleteAny(User $user): bool
    {
        return false;
    }
}

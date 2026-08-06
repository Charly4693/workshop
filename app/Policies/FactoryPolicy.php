<?php

namespace App\Policies;

use App\Models\Factory;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;

class FactoryPolicy extends AuthenticatedUserPolicy
{
    public function delete(User $user, Model $record): bool
    {
        return $record instanceof Factory && ! $record->isInUse();
    }

    public function deleteAny(User $user): bool
    {
        return false;
    }
}

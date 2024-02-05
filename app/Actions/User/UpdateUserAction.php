<?php

namespace App\Actions\User;

use App\DTO\UserData;
use App\Models\User;

class UpdateUserAction
{
    public function execute(User $user, UserData $data): void
    {
        $user->name = $data->getName();
        $user->email = $data->getEmail();

        $user->save();
    }
}

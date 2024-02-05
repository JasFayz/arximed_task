<?php

namespace App\Actions\User;

use App\DTO\UserData;
use App\Models\User;

class CreateUserAction
{
    public function execute(UserData $data)
    {
        $user = new User();
        $user->name = $data->getName();
        $user->email = $data->getEmail();
        $user->password = $data->getPassword();
        $user->save();

        return $user;
    }
}

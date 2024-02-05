<?php

namespace App\Actions\User;

use App\Models\User;

class SetUserAsAdmin
{
    public function execute(User $user): void
    {
        $user->update(['is_admin' => true]);
    }
}

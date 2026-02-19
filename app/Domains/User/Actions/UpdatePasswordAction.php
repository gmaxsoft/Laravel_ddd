<?php

namespace App\Domains\User\Actions;

use App\Domains\User\Models\User;

class UpdatePasswordAction
{
    /**
     * Update user password. Password is hashed via model cast.
     */
    public function execute(User $user, string $newPassword): void
    {
        $user->update([
            'password' => $newPassword,
        ]);
    }
}

<?php

namespace App\Domains\User\Actions;

use App\Domains\User\Models\User;

class UpdateProfileDataAction
{
    /**
     * Update user profile data (name, email).
     *
     * @param  array{name: string, email: string}  $data
     */
    public function execute(User $user, array $data): User
    {
        $user->update([
            'name' => $data['name'],
            'email' => $data['email'],
        ]);

        return $user->fresh();
    }
}

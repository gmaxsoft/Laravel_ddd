<?php

namespace App\Domains\Auth\Actions;

use App\Domains\User\Models\User;

class RegisterUserAction
{
    /**
     * Create a new user. Password is hashed via model cast.
     *
     * @param  array{name: string, email: string, password: string}  $data
     */
    public function execute(array $data): User
    {
        return User::query()->create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => $data['password'],
        ]);
    }
}

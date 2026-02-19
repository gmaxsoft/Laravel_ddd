<?php

namespace App\Domains\Auth\Actions;

use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Support\Facades\Auth;

class LoginUserAction
{
    /**
     * Attempt to authenticate the user with the given credentials.
     *
     * @param  array{email: string, password: string, remember: bool}  $credentials
     */
    public function execute(array $credentials): bool
    {
        return Auth::attempt(
            [
                'email' => $credentials['email'],
                'password' => $credentials['password'],
            ],
            $credentials['remember'] ?? false
        );
    }

    /**
     * Get the currently authenticated user.
     */
    public function user(): ?Authenticatable
    {
        return Auth::user();
    }
}

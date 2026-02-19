<?php

namespace Tests\Unit\Domains\Auth;

use App\Domains\Auth\Actions\LoginUserAction;
use App\Domains\User\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class LoginUserActionTest extends TestCase
{
    use RefreshDatabase;

    public function test_returns_true_for_valid_credentials(): void
    {
        User::factory()->create([
            'email' => 'user@example.com',
            'password' => 'Password123!',
        ]);

        $action = new LoginUserAction;

        $result = $action->execute([
            'email' => 'user@example.com',
            'password' => 'Password123!',
            'remember' => false,
        ]);

        $this->assertTrue($result);
    }

    public function test_returns_false_for_invalid_password(): void
    {
        User::factory()->create([
            'email' => 'user@example.com',
            'password' => 'Password123!',
        ]);

        $action = new LoginUserAction;

        $result = $action->execute([
            'email' => 'user@example.com',
            'password' => 'WrongPassword',
            'remember' => false,
        ]);

        $this->assertFalse($result);
    }

    public function test_returns_false_for_nonexistent_email(): void
    {
        $action = new LoginUserAction;

        $result = $action->execute([
            'email' => 'unknown@example.com',
            'password' => 'Password123!',
            'remember' => false,
        ]);

        $this->assertFalse($result);
    }

    public function test_remember_defaults_to_false_when_omitted(): void
    {
        User::factory()->create([
            'email' => 'user@example.com',
            'password' => 'Password123!',
        ]);

        $action = new LoginUserAction;

        $result = $action->execute([
            'email' => 'user@example.com',
            'password' => 'Password123!',
        ]);

        $this->assertTrue($result);
    }
}

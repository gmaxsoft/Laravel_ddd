<?php

namespace Tests\Unit\Domains\Auth;

use App\Domains\Auth\Actions\RegisterUserAction;
use App\Domains\User\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class RegisterUserActionTest extends TestCase
{
    use RefreshDatabase;

    public function test_creates_user_with_correct_data(): void
    {
        $action = new RegisterUserAction;

        $user = $action->execute([
            'name' => 'Jan Kowalski',
            'email' => 'jan@example.com',
            'password' => 'Password123!',
        ]);

        $this->assertInstanceOf(User::class, $user);
        $this->assertDatabaseHas('users', [
            'name' => 'Jan Kowalski',
            'email' => 'jan@example.com',
        ]);
        $this->assertNotEquals('Password123!', $user->password);
        $this->assertTrue(password_verify('Password123!', $user->password));
    }

    public function test_password_is_hashed(): void
    {
        $action = new RegisterUserAction;

        $user = $action->execute([
            'name' => 'Test User',
            'email' => 'test@example.com',
            'password' => 'SecretPass1!',
        ]);

        $this->assertStringStartsWith('$2y$', $user->password);
    }
}

<?php

namespace Tests\Unit\Domains\User;

use App\Domains\User\Actions\UpdatePasswordAction;
use App\Domains\User\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class UpdatePasswordActionTest extends TestCase
{
    use RefreshDatabase;

    public function test_updates_user_password(): void
    {
        $user = User::factory()->create([
            'password' => 'OldPassword123!',
        ]);

        $action = new UpdatePasswordAction;

        $action->execute($user, 'NewPassword456!');

        $user->refresh();
        $this->assertTrue(password_verify('NewPassword456!', $user->password));
        $this->assertFalse(password_verify('OldPassword123!', $user->password));
    }

    public function test_password_is_hashed(): void
    {
        $user = User::factory()->create();

        $action = new UpdatePasswordAction;

        $action->execute($user, 'PlainTextPassword1!');

        $user->refresh();
        $this->assertStringStartsWith('$2y$', $user->password);
    }
}

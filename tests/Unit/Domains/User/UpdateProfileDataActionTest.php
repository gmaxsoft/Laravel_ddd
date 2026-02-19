<?php

namespace Tests\Unit\Domains\User;

use App\Domains\User\Actions\UpdateProfileDataAction;
use App\Domains\User\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class UpdateProfileDataActionTest extends TestCase
{
    use RefreshDatabase;

    public function test_updates_user_name_and_email(): void
    {
        $user = User::factory()->create([
            'name' => 'Old Name',
            'email' => 'old@example.com',
        ]);

        $action = new UpdateProfileDataAction;

        $updated = $action->execute($user, [
            'name' => 'New Name',
            'email' => 'new@example.com',
        ]);

        $this->assertEquals('New Name', $updated->name);
        $this->assertEquals('new@example.com', $updated->email);
        $this->assertDatabaseHas('users', [
            'id' => $user->id,
            'name' => 'New Name',
            'email' => 'new@example.com',
        ]);
    }

    public function test_returns_fresh_model_instance(): void
    {
        $user = User::factory()->create();

        $action = new UpdateProfileDataAction;

        $updated = $action->execute($user, [
            'name' => 'Updated Name',
            'email' => 'updated@example.com',
        ]);

        $this->assertNotSame($user, $updated);
        $this->assertEquals($user->id, $updated->id);
    }
}

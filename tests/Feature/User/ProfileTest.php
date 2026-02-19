<?php

namespace Tests\Feature\User;

use App\Domains\User\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ProfileTest extends TestCase
{
    use RefreshDatabase;

    public function test_guest_cannot_access_profile(): void
    {
        $response = $this->get(route('profile.edit'));

        $response->assertRedirect(route('login'));
    }

    public function test_profile_edit_form_is_displayed(): void
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)->get(route('profile.edit'));

        $response->assertStatus(200);
        $response->assertViewIs('user.profile.edit');
        $response->assertViewHas('user', $user);
    }

    public function test_user_can_update_profile_data(): void
    {
        $user = User::factory()->create([
            'name' => 'Old Name',
            'email' => 'old@example.com',
        ]);

        $response = $this->actingAs($user)->patch(route('profile.update'), [
            'name' => 'New Name',
            'email' => 'new@example.com',
        ]);

        $response->assertRedirect();
        $response->assertSessionHas('status', 'profile-updated');
        $user->refresh();
        $this->assertEquals('New Name', $user->name);
        $this->assertEquals('new@example.com', $user->email);
    }

    public function test_user_can_update_password(): void
    {
        $user = User::factory()->create([
            'password' => 'OldPassword123!',
        ]);

        $response = $this->actingAs($user)->put(route('profile.password.update'), [
            'current_password' => 'OldPassword123!',
            'password' => 'NewPassword456!',
            'password_confirmation' => 'NewPassword456!',
        ]);

        $response->assertRedirect();
        $response->assertSessionHas('status', 'password-updated');
        $user->refresh();
        $this->assertTrue(password_verify('NewPassword456!', $user->password));
    }

    public function test_password_update_fails_with_wrong_current_password(): void
    {
        $user = User::factory()->create([
            'password' => 'OldPassword123!',
        ]);

        $response = $this->actingAs($user)->put(route('profile.password.update'), [
            'current_password' => 'WrongCurrentPassword',
            'password' => 'NewPassword456!',
            'password_confirmation' => 'NewPassword456!',
        ]);

        $response->assertSessionHasErrors('current_password');
        $user->refresh();
        $this->assertTrue(password_verify('OldPassword123!', $user->password));
    }

    public function test_profile_update_fails_with_duplicate_email(): void
    {
        $otherUser = User::factory()->create(['email' => 'taken@example.com']);
        $user = User::factory()->create(['email' => 'user@example.com']);

        $response = $this->actingAs($user)->patch(route('profile.update'), [
            'name' => 'User Name',
            'email' => 'taken@example.com',
        ]);

        $response->assertSessionHasErrors('email');
        $user->refresh();
        $this->assertEquals('user@example.com', $user->email);
    }
}

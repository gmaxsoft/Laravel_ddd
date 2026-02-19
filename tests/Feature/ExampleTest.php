<?php

namespace Tests\Feature;

// use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ExampleTest extends TestCase
{
    /**
     * Root redirects to login when guest.
     */
    public function test_the_application_redirects_to_login_when_guest(): void
    {
        $response = $this->get('/');

        $response->assertRedirect(route('login'));
    }
}

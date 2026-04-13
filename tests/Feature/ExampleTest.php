<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\Staff;

class ExampleTest extends TestCase
{
    use RefreshDatabase;

    public function test_the_application_returns_a_successful_response(): void
    {
        $response = $this->get('/');
        $response->assertStatus(200);
    }

    public function test_home_route_returns_welcome_message()
    {
        $response = $this->getJson('/api/home');
        $response->assertStatus(200) ->assertExactJson([ 'message' => 'Welcome ComePizza!🍕 API', 'by' => 'yangpimpollo' ]);
    }

    public function test_home_login_route_returns_message()
    {
        $response = $this->getJson('/api/home.login');
        $response->assertStatus(200) ->assertExactJson([ 'message' => 'iniciar sección' ]);
    }

    public function test_user_can_login_with_valid_credentials()
    {
        $response = $this->postJson('/api/home.login', [
            'dni' => 10000000, 
            'password' => 'pizza123',
        ]);

        $response->assertStatus(200) ->assertJsonStructure(['token', 'message']);

        $token = $response->json('token');
    }

    public function test_user_cannot_login_with_invalid_credentials()
    {
        $response = $this->postJson('/api/home.login', [
            'dni' => 10000000, 
            'password' => 'wrongpassword',
        ]);

        $response->assertStatus(422);
    }

    public function test_user_can_logout()
    {
        $loginResponse = $this->postJson('/api/home.logout', [
            'dni' => 10000000, 
            'password' => 'pizza123',
        ]);
}
<?php

namespace Tests\Feature;

use Illuminate\Http\JsonResponse as Response;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Laravel\Sanctum\Sanctum;
use App\Models\User;
use Tests\TestCase;
use UserSeeder;

class UserTest extends TestCase {
    
    use RefreshDatabase;
    
    /**
     * It's will be returns an Unauthorized
     * when user not logged in (Not privide token)
     */
    public function testItReturnsAnUnauthorizedErrorWhenUserNotLoggedIn() {
        $response = $this->getJson(route('user'));
        $response
            ->assertStatus(Response::HTTP_UNAUTHORIZED)
            ->assertJson([
                // Coy... login dulu yak..
                "message" => "Unauthenticated."
            ]);
    }

    public function testSanctum() {
        Sanctum::actingAs(
            User::factory()->create(),
            ['*']
        );
        $response = $this->get(route('user'));
        $response
            ->assertStatus(Response::HTTP_OK);
    }
}

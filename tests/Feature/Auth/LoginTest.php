<?php

namespace Tests\Feature\Auth;

use Illuminate\Http\JsonResponse as Response;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class LoginTest extends TestCase {

    use RefreshDatabase;
    
     /**
     * It's will be returns the current user
     * With token when successfully logged in
     */
    public function testItReturnsTheCurrentUserWithTokenWhenSuccessfullyLoggedIn() {
        $user = [
            'email' => '79thuy@gmail.com',
            'password'  => 'secret'
        ];
        $register = $this->register();
        $response = $this->postJson(route('login'), $user);
        $response
            ->assertStatus(Response::HTTP_OK)
            ->assertJson([
                'success' => true,
                'user' => [
                    'email' => $user['email']
                ],
            ]);
    }

    protected function register() {
        return $this->postJson(
            route('register'),
            $this->getCredentials()
        );
    }
}

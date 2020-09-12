<?php

namespace Tests\Feature\Auth;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Http\JsonResponse as Response;
use Illuminate\Support\Str;
use App\Models\User;
use Tests\TestCase;

class RegistrationTest extends TestCase {

    use RefreshDatabase, WithFaker;

    /** 
     * Register user
     * @return json $response
     */
    protected function registerUser() {
        $response  = $this->postJson(
            route('register'),
            $this->getRandomCredentials()
        );
        return $response;
    }

    /**
     * Test Register
     * A guest can be register
     */
    public function testGuestCanBeRegisterAndReturnToken() {
        $response = $this->registerUser();
        $response
            ->assertStatus(Response::HTTP_CREATED)
            ->assertJson([
                'success' => true,
            ]);
        $this->assertNotNull($response['token']);
    }


    /**
     * To be registered a guest must be confirm password
     */
    public function testToBeRegisteredGuestMustBeConfirmPassword() {
        $invalidCredentials = [
            'name'      => $this->faker->name,
            'email'     => $this->faker->safeEmail,
            'password'  => 'Lorem ipsum dolor, Oh Shit!! amit-amit jabang bayi!',
            'password_confirmation' => '',
        ];

        $response = $this->postJson(
            route('register'),
            $invalidCredentials
        );
        
        $response
            ->assertStatus(Response::HTTP_UNPROCESSABLE_ENTITY)
            ->assertExactJson([
                'success' => false,
                'message' => [
                    'password' => [
                        'The password confirmation does not match.'
                    ]
                ]
            ]);
    }


    /**
     * Test generate safe-username
     * if username field is empty / null
     */
    public function testGenerateSafeUsernameForNewUserRegisteredIfUsernameColumnIsEmpy() {
        $response = $this->registerUser();
        $name = $response['user']['name'];
        $username = $response['user']['username'];
        $this->assertStringContainsString(Str::slug($name), $username);
        $this->assertNotEquals(Str::slug($name), $username);
    }


    /**
     * Guest can register with custom username
     */
    public function testGuestCanRegisterWithCustomUsername() {
        $username = '79riskideptrai';
        $credentials  = [
            'name'      => $this->faker->name,
            'email'     => $this->faker->safeEmail,
            'username'  => $username,
            'password'  => 'secret',
            'password_confirmation' => 'secret'
        ];
        $response = $this->postJson(
            route('register'),
            $credentials,
        );
        $response
            ->assertStatus(Response::HTTP_CREATED)
            ->assertJson([
                'success' => true,
                'user' => [
                    'username' => $username
                ]
            ]);
    }


    /**
     * A guest can't be register with email that has already been taken.
     */
    public function testGuestCannotBeRegisterWithEmailThatHasAlreadyBeenTaken() {
        $response = $this->postJson(
            route('register'),
            $this->getCredentials()
        );
        /** register again with the same credentials (email) */
        $response = $this->postJson(
            route('register'),
            $this->getCredentials()
        );
        $response
            ->assertStatus(Response::HTTP_UNPROCESSABLE_ENTITY)
            ->assertJson([
                'success' => false,
                'message' => [
                    // Coy.. email ini udah ada yang pakai
                    'email' => ['The email has already been taken.']
                ],
            ]);
    }
}

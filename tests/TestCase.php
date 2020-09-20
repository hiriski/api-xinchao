<?php

namespace Tests;
use App\Models\User;
use Laravel\Sanctum\Sanctum;

use Illuminate\Foundation\Testing\TestCase as BaseTestCase;

abstract class TestCase extends BaseTestCase {
    use CreatesApplication;

    public function getCredentials() {
        return $credentias = [
            'name'      => 'Nguyen Thuy',
            'email'     => '79thuy@gmail.com',
            'password'  => 'secret',
            'password_confirmation' => 'secret',
        ];
    }
    
    public function getRandomCredentials() {
        return $credentias = [
            'name'      => /* 'Riski', */ $this->faker->name,
            'email'     => /* '79ki@gmail.com', */ $this->faker->email,
            'password'  => 'secret',
            'password_confirmation' => 'secret',
        ];
    }

    public function sanctumAuth() {
        Sanctum::actingAs(
            User::factory()->create(),
            ['*']
        );
    }
    
}

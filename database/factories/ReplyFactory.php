<?php

namespace Database\Factories;

use App\Models\User;
use App\Models\Reply;
use App\Models\Discussion;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class ReplyFactory extends Factory {
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Reply::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition() {
        return [
            'user_id'       => User::factory(),
            'discussion_id' => Discussion::factory(),
            'content'       => $this->faker->paragraph,
        ];
    }
}

<?php

namespace Database\Factories;

use App\Models\User;
use App\Models\Topic;
use App\Models\Discussion;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class DiscussionFactory extends Factory {
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Discussion::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition() {
        return [
            'title' => $this->faker->sentence(5),
            'description' => $this->faker->paragraph,
            'content' => $this->faker->text,
            'topic_id' => Topic::factory(),
            'user_id'  => User::factory(),
        ];
    }
}

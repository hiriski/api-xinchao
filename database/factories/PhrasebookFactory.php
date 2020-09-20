<?php

namespace Database\Factories;

use App\Models\Phrasebook;
use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\PhrasebookCategory as Category;
use App\Models\User;

class PhrasebookFactory extends Factory {
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Phrasebook::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition() {
        return [
            'id_ID' => $this->faker->sentence,
            'vi_VN' => $this->faker->sentence,
            'en_US' => $this->faker->sentence,
            'notes' => $this->faker->paragraph,
            'category_id' => Category::factory(),
            'created_by' => User::factory(),
        ];
    }
}

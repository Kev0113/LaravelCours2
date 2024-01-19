<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Event>
 */
class EventFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return[
            'title' => $this->faker->name(),
            'content' => $this->faker->paragraph(),
            'starting_date' => $this->faker->dateTimeThisCentury(),
            'ending_date' => $this->faker->dateTimeThisCentury(),
            'tags' => $this->faker->word(),
            'is_public' => $this->faker->boolean(),
            'user_id' => User::all()->random()->id,
            'category_id' => User::all()->random()->id,
            'price' => $this->faker->randomNumber(),
        ];
    }
}

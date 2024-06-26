<?php

namespace Database\Factories;

use App\Models\Drink;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Drink>
 */
class DrinkFactory extends Factory
{
    public function definition(): array
    {
        return [
            "name" => 'Drink: ' . $this->faker->unique()->words(rand(1, 6), true),
        ];
    }

    public function user(): static
    {
        return $this->state(fn(array $attributes) => ['user_id' => User::factory()->create()->getKey()]);
    }

    public function published(): static
    {
        return $this->state(fn(array $attributes) => ['published' => true]);
    }
}

<?php

namespace Database\Factories;

use App\Models\Drink;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Drink>
 */
class DrinkFactory extends Factory
{
    public function definition(): array
    {
        return [
            "name" => $this->faker->unique()->words(rand(1, 6), true),
        ];
    }

    public function published(): static
    {
        return $this->state(fn(array $attributes) => ['published' => true]);
    }
}

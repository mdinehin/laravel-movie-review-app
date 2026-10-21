<?php

namespace Database\Factories;

use App\Models\Movie;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Movie>
 */
class MovieFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'title' => fake()->sentence(3),
            'director' => fake()->name(),
            'created_at' => fake()->dateTimeBetween('-2 years'),
            'updated_at' => fn (array $attributes) => fake()->dateTimeBetween($attributes['created_at'], 'now'),
        ];
    }
}

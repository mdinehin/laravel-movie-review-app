<?php

namespace Database\Factories;

use App\Models\Review;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Review>
 */
class ReviewFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'movie_id' => null,
            'review' => fake()->paragraph,
            'rating' => fake()->numberBetween(1, 5),
            'created_at' => fake()->dateTimeBetween('-2 years'),
            'updated_at' => fn (array $attributes) =>
                fake()->dateTimeBetween($attributes['created_at'], 'now'),
        ];
    }

    /**
     * Indicate that the model's rating should be good.
     */
    public function goodReting(): static
    {
        return $this->state(fn (array $attributes) => [
            'rating' => fake()->numberBetween(4, 5),
        ]);
    }

    /**
     * Indicate that the model's rating should be neutral.
     */
    public function neutralReting(): static
    {
        return $this->state(fn (array $attributes) => [
            'rating' => fake()->numberBetween(2, 5),
        ]);
    }

    /**
     * Indicate that the model's rating should be bad.
     */
    public function badReting(): static
    {
        return $this->state(fn (array $attributes) => [
            'rating' => fake()->numberBetween(1, 3),
        ]);
    }
}

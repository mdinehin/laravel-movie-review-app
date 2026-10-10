<?php

namespace Database\Seeders;

use App\Models\Movie;
use App\Models\Review;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        Movie::factory(33)
            ->create()
            ->each(function (Movie $movie) {
                $reviewCount = random_int(5, 30);

                Review::factory()
                    ->count($reviewCount)
                    ->goodReting()
                    ->for($movie)
                    ->create();
        });

        Movie::factory(33)
            ->create()
            ->each(function (Movie $movie) {
                $reviewCount = random_int(5, 30);

                Review::factory()
                    ->count($reviewCount)
                    ->neutralReting()
                    ->for($movie)
                    ->create();
        });

        Movie::factory(34)
            ->create()
            ->each(function (Movie $movie) {
                $reviewCount = random_int(5, 30);

                Review::factory()
                    ->count($reviewCount)
                    ->badReting()
                    ->for($movie)
                    ->create();
        });
    }
}

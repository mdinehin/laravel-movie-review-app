<?php

namespace App\Models;

use Database\Factories\MovieFactory;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Movie extends Model
{
    /** @use HasFactory<MovieFactory> */
    use HasFactory;

    /**
     * Define Movie-Review relationship.
     *
     * @return HasMany<Review, $this>
     */
    public function reviews(): HasMany
    {
        return $this->hasMany(Review::class);
    }

    /**
     * Scope a query to search movies by title.
     *
     * @param  Builder<static>  $query
     * @return Builder<static>
     */
    public function scopeTitle(Builder $query, string $title): Builder
    {
        return $query
            ->where('title', 'like', '%'.$title.'%');
    }

    /**
     * Return movies with a "reviews_count" column within a given date range.
     *
     * @param  Builder<static>  $query
     * @return Builder<static>
     */
    public function scopeWithReviewsCount(Builder $query, ?string $from = null, ?string $to = null): Builder
    {
        return $query
            ->withCount([
                'reviews' => fn (Builder $q) => $this->dateRangeFilter($q, $from, $to),
            ]);
    }

    /**
     * Return movies with a "reviews_avg_rating" column within a given date range.
     *
     * @param  Builder<static>  $query
     * @return Builder<static>
     */
    public function scopeWithAvgRating(Builder $query, ?string $from = null, ?string $to = null): Builder
    {
        return $query
            ->withAvg([
                'reviews' => fn (Builder $q) => $this->dateRangeFilter($q, $from, $to),
            ], 'rating');
    }

    /**
     * Order movies by review count within a given date range.
     *
     * @param  Builder<static>  $query
     * @return Builder<static>
     */
    public function scopeMostPopular(Builder $query, ?string $from = null, ?string $to = null): Builder
    {
        return $query
            ->withReviewsCount($from, $to)
            ->orderBy('reviews_count', 'desc');
    }

    /**
     * Order movies by review average rating within a given date range.
     *
     * @param  Builder<static>  $query
     * @return Builder<static>
     */
    public function scopeHighestRated(Builder $query, ?string $from = null, ?string $to = null): Builder
    {
        return $query
            ->withAvgRating($from, $to)
            ->orderBy('reviews_avg_rating', 'desc');
    }

    /**
     * Filter movies by a minimum review count.
     *
     * @param  Builder<static>  $query
     * @return Builder<static>
     */
    public function scopeMinimumReviews(Builder $query, int $minimumReviews): Builder
    {
        return $query
            ->having('reviews_count', '>=', $minimumReviews);
    }

    /**
     * Apply a date range filter to the query.
     *
     * @param  Builder<static>  $query
     */
    private function dateRangeFilter(Builder $query, ?string $from = null, ?string $to = null): void
    {
        if ($from && ! $to) {
            $query->where('created_at', '>=', $from);
        } elseif (! $from && $to) {
            $query->where('created_at', '<=', $to);
        } elseif ($from && $to) {
            $query->whereBetween('created_at', [$from, $to]);
        }
    }

    /**
     * Return the most popular movies based on review count and average rating from the last month.
     *
     * @param  Builder<static>  $query
     * @return Builder<static>
     */
    public function scopePopularLastMonth(Builder $query): Builder
    {
        return $query
            ->mostPopular(now()->subMonth(), now())
            ->highestRated(now()->subMonth(), now())
            ->minimumReviews(2);
    }

    /**
     * Return the most popular movies based on review count and average rating from the last 6 months.
     *
     * @param  Builder<static>  $query
     * @return Builder<static>
     */
    public function scopePopularLast6Months(Builder $query): Builder
    {
        return $query
            ->mostPopular(now()->subMonths(6), now())
            ->highestRated(now()->subMonths(6), now())
            ->minimumReviews(5);
    }

    /**
     * Return the most popular movies based on average rating and review count from the last month.
     *
     * @param  Builder<static>  $query
     * @return Builder<static>
     */
    public function scopeHighestRatedLastMonth(Builder $query): Builder
    {
        return $query
            ->highestRated(now()->subMonth(), now())
            ->mostPopular(now()->subMonth(), now())
            ->minimumReviews(2);
    }

    /**
     * Return the most popular movies based on average rating and review count from the last 6 months.
     *
     * @param  Builder<static>  $query
     * @return Builder<static>
     */
    public function scopeHighestRatedLast6Months(Builder $query): Builder
    {
        return $query
            ->highestRated(now()->subMonths(6), now())
            ->mostPopular(now()->subMonths(6), now())
            ->minimumReviews(5);
    }

    /**
     * Flush movie query caches when a movie is updated or deleted.
     */
    protected static function booted(): void
    {
        static::updated(fn (Movie $movie) => cache()->forget('movie:'.$movie->id));

        static::deleted(fn (Movie $movie) => cache()->forget('movie:'.$movie->id));
    }
}

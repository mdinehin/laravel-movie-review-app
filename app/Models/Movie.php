<?php

namespace App\Models;

use Database\Factories\MovieFactory;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Movie extends Model
{
    /** @use HasFactory<MovieFactory> */
    use HasFactory;

    /**
     * Define Movie-Review relationship.
     */
    public function reviews()
    {
        return $this->hasMany(Review::class);
    }

    /**
     * Filter movies by title.
     */
    public function scopeTitle(Builder $query, string $title): Builder
    {
        return $query
            ->where('title', 'like', '%' . $title . '%');
    }

    /**
     * Order movies by review count.
     */
    public function scopePopular(Builder $query, ?string $from = null, ?string $to = null): Builder
    {
        return $query
            ->withCount([
                'reviews' => fn (Builder $q) =>
                    $this->dateRangeFilter($q, $from, $to),
            ])
            ->orderBy('reviews_count', 'desc');
    }

    /**
     * Order movies by review average rating.
     */
    public function scopeHighestRated(Builder $query, ?string $from = null, ?string $to = null): Builder
    {
        return $query
            ->withAvg([
                'reviews' => fn (Builder $q) =>
                    $this->dateRangeFilter($q, $from, $to),
            ], 'rating')
            ->orderBy('reviews_avg_rating', 'desc');
    }

    /**
     * Filter movies by a minimum review count.
     */
    public function scopeMinimumReviews(Builder $query, int $minimumReviews): Builder
    {
        return $query
            ->having('reviews_count', '>=', $minimumReviews);
    }

    /**
     * Apply a date range filter to the query.
     */
    private function dateRangeFilter(Builder $query, ?string $from = null, ?string $to = null): void
    {
        if ($from && ! $to) {
            $query->where('created_at','>=', $from);
        } else if (! $from && $to) {
            $query->where('created_at','<=', $to);
        } else {
            $query->whereBetween('created_at', [$from, $to]);
        }
    }
}

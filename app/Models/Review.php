<?php

namespace App\Models;

use Database\Factories\ReviewFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Review extends Model
{
    /** @use HasFactory<ReviewFactory> */
    use HasFactory;

    protected $fillable = [
        'review',
        'rating',
    ];

    /**
     * Define Movie-Review relationship.
     *
     * @return BelongsTo<Movie, $this>
     */
    public function movie(): BelongsTo
    {
        return $this->belongsTo(Movie::class);
    }

    /**
     * Flush movie query caches when a review is updated or deleted.
     */
    protected static function booted(): void
    {
        static::created(fn (Review $review) => cache()->forget('movie:'.$review->movie_id));

        static::updated(fn (Review $review) => cache()->forget('movie:'.$review->movie_id));

        static::deleted(fn (Review $review) => cache()->forget('movie:'.$review->movie_id));
    }
}

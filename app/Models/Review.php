<?php

namespace App\Models;

use Database\Factories\ReviewFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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
     */
    public function movie()
    {
        return $this->belongsTo(Movie::class);
    }
}

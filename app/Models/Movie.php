<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Movie extends Model
{
    /**
     * Define Movie-Review relationship.
     */
    public function reviews()
    {
        return $this->hasMany(Review::class);
    }
}

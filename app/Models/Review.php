<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    /**
     * Define Movie-Review relationship.
     */
    public function movie()
    {
        return $this->belongsTo(Movie::class);
    }
}

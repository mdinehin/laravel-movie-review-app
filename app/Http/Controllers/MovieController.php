<?php

namespace App\Http\Controllers;

use App\Models\Movie;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Http\Request;

class MovieController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $title = $request->input('title');
        $filter = $request->input('filter', '');

        $movies = Movie::when($title, fn (Builder $query) =>
            $query->title($title)
        );

        $movies = match($filter) {
                'popular_last_month' => $movies->popularLastMonth(),
                'popular_last_6months' => $movies->popularLast6Months(),
                'highest_rated_last_month' => $movies->highestRatedLastMonth(),
                'highest_rated_last_6months' => $movies->highestRatedLast6Months(),
                default => $movies->latest(),
        };

        $movies = $movies->get();

        return view('movies.index', ['movies' => $movies]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Movie $movie)
    {
        return view(
            'movies.show',
            [
                'movie' => $movie->load([
                    'reviews' => fn (HasMany $query) =>
                        $query->latest(),
                ])
            ]
        );
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}

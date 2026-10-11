@extends('layouts.app')

@section('content')
    <h1 class="mb-10 text-2x1">Movies</h1>

    <form></form>

    <ul>
        @forelse($movies as $movie)
            <li class="mb-4">
                <div class="movie-item">
                    <div class="flex flex-wrap items-center justify-between">
                        <div class="w-full flex-grow sm:w-auto">
                            <a href="{{ route('movies.show', $movie) }}" class="movie-title">{{ $movie->title }}</a>
                            <span class="movie-director">by {{ $movie->director }}</span>
                        </div>
                        <div>
                            <div class="movie-rating">
                                <span>{{ number_format($movie->reviews_avg_rating, 1) }}</span>
                            </div>
                            <div class="movie-review-count">
                                <span>out of {{ $movie->reviews_count }} {{ Str::plural('review', $movie->reviews_count) }}</span>
                            </div>
                        </div>
                    </div>
                </div>
            </li>
        @empty
            <li class="mb-4">
                <div class="empty-movie-item">
                    <p class="empty-text">No movies found</p>
                    <a href="{{ route('movies.index') }}" class="reset-link">Reset criteria</a>
                </div>
            </li>
        @endforelse
    </ul>
@endsection

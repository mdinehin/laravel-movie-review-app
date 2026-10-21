@extends('layouts.app')

@section('content')
    <h1 class="mb-10 text-2x1">Movies</h1>

    <form method="GET" action="{{ route('movies.index') }}"
        class="mb-4 flex items-center space-x-2"
    >
        <input class="input h-10" type="text" name="title" id="title" placeholder="Search by title"
            value="{{ request('title') }}"
        />
        @if(request('filter'))
            <input type="hidden" name="filter" value="{{ request('filter') }}" />
        @endif
        <button class="btn h-10" type="submit">Search</button>
        <a href="{{ route('movies.index') }}" class="btn h-10">Clear</a>
    </form>

    <div class="filter-container mb-4 flex">
        @php
            $filters = [
                '' => 'Latest',
                'popular_last_month' => 'Popular latest month',
                'popular_last_6months' => 'Popular latest 6 months',
                'highest_rated_last_month' => 'Highest rated latest month',
                'highest_rated_last_6months' => 'Highest rated latest 6 months',
            ];
        @endphp

        @foreach($filters as $key => $label)
            <a
                @if($key === '')
                    href="{{ route('movies.index', [
                        ...request()->except('filter'),
                    ]) }}"
                @else
                    href="{{ route('movies.index', [
                        ...request()->query(),
                        'filter' => $key,
                    ]) }}"
                @endif
                class="{{
                    (
                        request('filter') === $key
                        || (
                            request('filter') === null
                            && $key === ''
                        )
                    )
                        ? 'filter-item-active'
                        : 'filter-item'
                }}"
            >
                <span>{{ $label }}</span>
            </a>
        @endforeach
    </div>

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
                                <span class="mr-1">{{ number_format($movie->reviews_avg_rating, 1) }}</span>
                                <span><x-star-rating :rating="$movie->reviews_avg_rating" /></span>
                            </div>
                            <div class="movie-review-count">
                                <span class="ml-auto">out of {{ $movie->reviews_count }} {{ Str::plural('review', $movie->reviews_count) }}</span>
                            </div>
                        </div>
                    </div>
                </div>
            </li>
        @empty
            <li class="mb-4">
                <div class="empty-movie-item">
                    <p class="empty-text">No movies found</p>
                    <a href="{{ route('movies.index') }}" class="reset-link">Clear search</a>
                </div>
            </li>
        @endforelse
    </ul>
@endsection

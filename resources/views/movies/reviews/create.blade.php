@extends('layouts.app')

@section('content')
    <h1 class="mb-8 text-2xl">Add a review for {{ $movie->title }}</h1>

    <form method="POST" action="{{ route('movies.reviews.store', $movie) }}">
        @csrf
        <label for="review">Review</label>
        <textarea name="review" id="review" required class="input mb-4"
            placeholder="Minimum 10 characters"
        ></textarea>

        <label for="rating">Rating</label>
        <select name="rating" id="rating" class="input mb-8" required>
            <option value="">Select a rating</option>
            @for($i = 1; $i <= 5; $i++)
                <option value="{{ $i }}">{{ $i }}</option>
            @endfor
        </select>

        <div class="flex items-center space-x-2">
            <button type="submit" class="btn">
                <span>Add review</span>
            </button>
            <a href="{{ route('movies.show', $movie) }}" class="btn">Cancel</a>
        </div>
    </form>
@endsection

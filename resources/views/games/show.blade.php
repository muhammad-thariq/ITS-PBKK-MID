@extends('layout')

@section('content')
  <div class="flex items-start justify-between mb-4">
    <h1 class="text-2xl font-bold">{{ $game->title }}</h1>
    <a href="{{ route('games.edit',$game) }}" class="px-3 py-2 rounded-md border hover:bg-gray-100">Edit</a>
  </div>

  <div class="bg-white rounded-lg border p-4 mb-6">
    <p><span class="font-semibold">Genre:</span> {{ $game->genre ?? '—' }}</p>
    <p><span class="font-semibold">Release Year:</span> {{ $game->release_year ?? '—' }}</p>
    <p class="mt-2 whitespace-pre-line">{{ $game->description ?? 'No description.' }}</p>
    <p class="mt-2"><span class="font-semibold">Average Rating:</span>
      {{ $game->reviews->count() ? round($game->reviews->avg('rating'),1) : '—' }}
    </p>
  </div>

  <h2 class="text-xl font-semibold mb-2">Reviews</h2>
  <div class="space-y-3 mb-6">
    @forelse($game->reviews as $r)
      <div class="bg-white rounded-lg border p-3">
        <div class="flex items-center justify-between">
          <div class="font-medium">{{ $r->author ?: 'Anonymous' }}</div>
          <div class="text-sm text-gray-600">Rating: {{ $r->rating }}/10</div>
        </div>
        <p class="mt-1">{{ $r->body }}</p>
      </div>
    @empty
      <p>No reviews yet.</p>
    @endforelse
  </div>

  <h3 class="text-lg font-semibold mb-2">Add a Review</h3>
  <form method="POST" action="{{ route('reviews.store', $game) }}" class="space-y-3 bg-white p-4 rounded-lg border">
    @csrf
    <div>
      <label class="block text-sm font-medium">Author (optional)</label>
      <input name="author" value="{{ old('author') }}"
             class="w-full rounded-md border-gray-300 focus:border-indigo-500 focus:ring-indigo-500">
      @error('author') <p class="text-red-600 text-sm">{{ $message }}</p> @enderror
    </div>
    <div>
      <label class="block text-sm font-medium">Rating (1-10)</label>
      <input type="number" name="rating" min="1" max="10" value="{{ old('rating', 7) }}" required
             class="w-full rounded-md border-gray-300 focus:border-indigo-500 focus:ring-indigo-500">
      @error('rating') <p class="text-red-600 text-sm">{{ $message }}</p> @enderror
    </div>
    <div>
      <label class="block text-sm font-medium">Your thoughts</label>
      <textarea name="body" rows="3"
        class="w-full rounded-md border-gray-300 focus:border-indigo-500 focus:ring-indigo-500">{{ old('body') }}</textarea>
      @error('body') <p class="text-red-600 text-sm">{{ $message }}</p> @enderror
    </div>
    <button class="px-4 py-2 rounded-md bg-indigo-600 text-white hover:bg-indigo-700">Submit Review</button>
  </form>
@endsection

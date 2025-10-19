@extends('layout')

@section('content')
  <h1 class="text-2xl font-bold mb-4">Edit Game</h1>

  <form method="POST" action="{{ route('games.update',$game) }}" enctype="multipart/form-data"
        class="space-y-4 bg-white p-4 rounded-lg border">
    @csrf @method('PUT')

    <div>
      <label class="block text-sm font-medium">Title</label>
      <input name="title" value="{{ old('title', $game->title) }}" required
             class="w-full rounded-md border-gray-300 focus:border-indigo-500 focus:ring-indigo-500">
      @error('title') <p class="text-red-600 text-sm">{{ $message }}</p> @enderror
    </div>

    <div class="grid grid-cols-2 gap-4">
      <div>
        <label class="block text-sm font-medium">Genre</label>
        <input name="genre" value="{{ old('genre', $game->genre) }}"
               class="w-full rounded-md border-gray-300 focus:border-indigo-500 focus:ring-indigo-500">
        @error('genre') <p class="text-red-600 text-sm">{{ $message }}</p> @enderror
      </div>
      <div>
        <label class="block text-sm font-medium">Release Year</label>
        <input type="number" name="release_year" value="{{ old('release_year', $game->release_year) }}"
               class="w-full rounded-md border-gray-300 focus:border-indigo-500 focus:ring-indigo-500">
        @error('release_year') <p class="text-red-600 text-sm">{{ $message }}</p> @enderror
      </div>
    </div>

    <div>
      <label class="block text-sm font-medium">Description</label>
      <textarea name="description" rows="4"
        class="w-full rounded-md border-gray-300 focus:border-indigo-500 focus:ring-indigo-500">{{ old('description', $game->description) }}</textarea>
      @error('description') <p class="text-red-600 text-sm">{{ $message }}</p> @enderror
    </div>

    <div>
      <label class="block text-sm font-medium">Current Cover</label>
      @if($game->cover_url)
        <img src="{{ $game->cover_url }}" alt="cover" class="mt-1 h-32 w-32 object-cover rounded-md border">
      @else
        <p class="text-sm text-gray-600">No cover uploaded.</p>
      @endif
    </div>

    <div>
      <label class="block text-sm font-medium">Replace Cover (optional)</label>
      <input type="file" name="cover" accept="image/*"
             class="w-full rounded-md border-gray-300 file:mr-4 file:rounded-md file:border-0 file:bg-indigo-600 file:px-3 file:py-2 file:text-white hover:file:bg-indigo-700">
      @error('cover') <p class="text-red-600 text-sm">{{ $message }}</p> @enderror
    </div>

    <div class="flex gap-2">
      <button class="px-4 py-2 rounded-md bg-indigo-600 text-white hover:bg-indigo-700">Update</button>
      <a href="{{ route('games.show',$game) }}" class="px-4 py-2 rounded-md border hover:bg-gray-100">Cancel</a>
    </div>
  </form>
@endsection

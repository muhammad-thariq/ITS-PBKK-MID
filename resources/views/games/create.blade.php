@extends('layout')

@section('content')
  <h1 class="text-2xl font-bold mb-4">Add Game</h1>

  <form method="POST" action="{{ route('games.store') }}" class="space-y-4 bg-white p-4 rounded-lg border">
    @csrf

    <div>
      <label class="block text-sm font-medium">Title</label>
      <input name="title" value="{{ old('title') }}" required
             class="w-full rounded-md border-gray-300 focus:border-indigo-500 focus:ring-indigo-500">
      @error('title') <p class="text-red-600 text-sm">{{ $message }}</p> @enderror
    </div>

    <div class="grid grid-cols-2 gap-4">
      <div>
        <label class="block text-sm font-medium">Genre</label>
        <input name="genre" value="{{ old('genre') }}"
               class="w-full rounded-md border-gray-300 focus:border-indigo-500 focus:ring-indigo-500">
        @error('genre') <p class="text-red-600 text-sm">{{ $message }}</p> @enderror
      </div>
      <div>
        <label class="block text-sm font-medium">Release Year</label>
        <input type="number" name="release_year" value="{{ old('release_year') }}"
               class="w-full rounded-md border-gray-300 focus:border-indigo-500 focus:ring-indigo-500">
        @error('release_year') <p class="text-red-600 text-sm">{{ $message }}</p> @enderror
      </div>
    </div>

    <div>
      <label class="block text-sm font-medium">Description</label>
      <textarea name="description" rows="4"
        class="w-full rounded-md border-gray-300 focus:border-indigo-500 focus:ring-indigo-500">{{ old('description') }}</textarea>
      @error('description') <p class="text-red-600 text-sm">{{ $message }}</p> @enderror
    </div>

    <div class="flex gap-2">
      <button class="px-4 py-2 rounded-md bg-indigo-600 text-white hover:bg-indigo-700">Save</button>
      <a href="{{ route('games.index') }}" class="px-4 py-2 rounded-md border hover:bg-gray-100">Cancel</a>
    </div>
  </form>
@endsection

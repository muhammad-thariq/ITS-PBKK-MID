<x-app-layout>
  <x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800">Create Game</h2>
  </x-slot>

  <div class="mt-4"
       x-data="{ imageUrl: null, preview(e){ const f=e.target.files?.[0]; if(!f) return; imageUrl = URL.createObjectURL(f); } }">
    <form method="POST" action="{{ route('games.store') }}" enctype="multipart/form-data"
          class="flex flex-col sm:flex-row gap-8">
      @csrf

      <div class="sm:w-1/2">
        <template x-if="imageUrl">
          <img :src="imageUrl" class="rounded-md w-full aspect-square object-cover" alt="preview" />
        </template>
        <template x-if="!imageUrl">
          <div class="rounded-md w-full aspect-square bg-gray-100 flex items-center justify-center text-gray-400">
            No Image
          </div>
        </template>
      </div>

      <div class="w-full sm:w-1/2 space-y-4">
        <div>
          <label class="block text-sm font-medium">Title</label>
          <input name="title" value="{{ old('title') }}" required
                 class="w-full rounded-md border-gray-300 focus:border-indigo-500 focus:ring-indigo-500" />
          @error('title') <p class="text-red-600 text-sm">{{ $message }}</p> @enderror
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
          <div>
            <label class="block text-sm font-medium">Genre</label>
            <input name="genre" value="{{ old('genre') }}"
                   class="w-full rounded-md border-gray-300 focus:border-indigo-500 focus:ring-indigo-500" />
            @error('genre') <p class="text-red-600 text-sm">{{ $message }}</p> @enderror
          </div>
          <div>
            <label class="block text-sm font-medium">Release Year</label>
            <input type="number" name="release_year" value="{{ old('release_year') }}"
                   class="w-full rounded-md border-gray-300 focus:border-indigo-500 focus:ring-indigo-500" />
            @error('release_year') <p class="text-red-600 text-sm">{{ $message }}</p> @enderror
          </div>
        </div>

        <div>
          <label class="block text-sm font-medium">Description</label>
          <textarea name="description" rows="4"
                    class="w-full rounded-md border-gray-300 focus:border-indigo-500 focus:ring-indigo-500">{{ old('description') }}</textarea>
          @error('description') <p class="text-red-600 text-sm">{{ $message }}</p> @enderror
        </div>

        <div>
          <label class="block text-sm font-medium">Cover Image</label>
          <input type="file" name="cover" accept="image/*" @change="preview"
                 class="w-full rounded-md border-gray-300
                        file:mr-4 file:rounded-md file:border-0 file:bg-indigo-600
                        file:px-3 file:py-2 file:text-white hover:file:bg-indigo-700" />
          @error('cover') <p class="text-red-600 text-sm">{{ $message }}</p> @enderror
          <p class="text-xs text-gray-500 mt-1">JPG/PNG/WebP up to 2MB</p>
        </div>

        <div class="pt-2">
          <button class="w-full sm:w-auto px-4 py-2 rounded-md bg-indigo-600 text-white hover:bg-indigo-700">Submit</button>
          <a href="{{ route('games.index') }}" class="ml-2 px-4 py-2 rounded-md border hover:bg-gray-100">Cancel</a>
        </div>
      </div>
    </form>
  </div>
</x-app-layout>

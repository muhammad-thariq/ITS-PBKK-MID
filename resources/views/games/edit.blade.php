{{-- resources/views/games/edit.blade.php --}}
<x-app-layout>
  <div class="max-w-7xl mx-auto px-8">
    {{-- Header --}}
    <div class="flex flex-col md:flex-row my-9 items-start md:items-center justify-between px-6">
      <h2 class="text-white text-3xl font-semibold mb-4 md:mb-0">
        Edit: {{ $game->title }}
      </h2>

      <div class="flex flex-col md:flex-row gap-3 w-full md:w-auto">
        {{-- Back to Game --}}
        <a href="{{ route('games.show', $game) }}" class="w-full md:w-auto">
          <button class="w-full md:w-auto bg-white px-6 py-2 rounded-md font-semibold hover:bg-black hover:text-white hover:ring-2 hover:ring-white hover:ring-offset-2 transition">
            ← Back
          </button>
        </a>
      </div>
    </div>

    {{-- Form + Preview --}}
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 px-6 items-stretch">
      {{-- Left: Cover Preview (square) --}}
      <div class="w-full">
        <div class="w-full aspect-square rounded-md overflow-hidden bg-gray-100 flex items-center justify-center">
          @if($game->cover_url)
            <img id="coverPreview" src="{{ $game->cover_url }}" alt="{{ $game->title }} cover" class="w-full h-full object-cover">
          @else
            <img id="coverPreview" src="" alt="No cover" class="hidden w-full h-full object-cover">
            <span id="noImageLabel" class="text-gray-400">No Image</span>
          @endif
        </div>
      </div>

      {{-- Right: Card with form (re-using the same style) --}}
      <div class="w-full lg:mt-0">
        <div class="w-full lg:aspect-square">
          <div class="h-full rounded-xl bg-black p-[2px]">
            <div class="h-full bg-white rounded-lg p-6 shadow-sm flex flex-col overflow-hidden">
              <h3 class="text-lg font-semibold text-gray-900 shrink-0">Edit Game</h3>

              {{-- Validation errors --}}
              @if ($errors->any())
                <div class="mt-4 rounded-md border border-red-300 bg-red-50 p-3 text-sm text-red-700">
                  <ul class="list-disc pl-5 space-y-1">
                    @foreach ($errors->all() as $error)
                      <li>{{ $error }}</li>
                    @endforeach
                  </ul>
                </div>
              @endif

              <form
                action="{{ route('games.update', $game) }}"
                method="POST"
                enctype="multipart/form-data"
                class="mt-4 space-y-4 grow overflow-auto pr-1"
              >
                @csrf
                @method('PATCH')

                <div>
                  <label for="title" class="block text-sm font-medium text-gray-900">Title</label>
                  <input
                    id="title"
                    name="title"
                    type="text"
                    required
                    value="{{ old('title', $game->title) }}"
                    class="mt-1 w-full rounded-md border border-black bg-white px-3 py-2 focus:outline-none focus:ring-2 focus:ring-black"
                  />
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                  <div>
                    <label for="genre" class="block text-sm font-medium text-gray-900">Genre</label>
                    <input
                      id="genre"
                      name="genre"
                      type="text"
                      value="{{ old('genre', $game->genre) }}"
                      class="mt-1 w-full rounded-md border border-black bg-white px-3 py-2 focus:outline-none focus:ring-2 focus:ring-black"
                    />
                  </div>

                  <div>
                    <label for="release_year" class="block text-sm font-medium text-gray-900">Release Year</label>
                    <input
                      id="release_year"
                      name="release_year"
                      type="number"
                      inputmode="numeric"
                      min="1950"
                      max="{{ now()->year }}"
                      step="1"
                      value="{{ old('release_year', $game->release_year) }}"
                      class="mt-1 w-full rounded-md border border-black bg-white px-3 py-2 focus:outline-none focus:ring-2 focus:ring-black"
                    />
                  </div>
                </div>

                <div>
                  <label for="description" class="block text-sm font-medium text-gray-900">Description</label>
                  <textarea
                    id="description"
                    name="description"
                    rows="5"
                    class="mt-1 w-full rounded-md border border-black bg-white px-3 py-2 leading-relaxed focus:outline-none focus:ring-2 focus:ring-black"
                  >{{ old('description', $game->description) }}</textarea>
                </div>

                <div>
                  <label for="cover" class="block text-sm font-medium text-gray-900">Cover Image</label>
                  <input
                    id="cover"
                    name="cover"
                    type="file"
                    accept="image/*"
                    class="mt-1 w-full rounded-md border border-dashed border-black bg-white px-3 py-2 focus:outline-none focus:ring-2 focus:ring-black"
                  />
                  <p class="mt-1 text-xs text-gray-500">JPG/PNG/WEBP up to 2MB.</p>
                </div>

                <div class="pt-10 ml-1 flex items-center gap-3">
                  <button
                    type="submit"
                    class="bg-black text-white px-6 py-2 rounded-md font-semibold hover:bg-white hover:text-black hover:ring-2 hover:ring-black hover:ring-offset-2 transition"
                  >
                    Save Changes
                  </button>

                  <a href="{{ route('games.show', $game) }}" class="text-sm underline text-gray-700 hover:text-black">
                    Cancel
                  </a>
                </div>
              </form>

            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  {{-- Real-time image preview --}}
  <script>
    (function () {
      const input = document.getElementById('cover');
      if (!input) return;

      const preview = document.getElementById('coverPreview');
      const noImageLabel = document.getElementById('noImageLabel');

      input.addEventListener('change', function () {
        const [file] = this.files || [];
        if (file) {
          const url = URL.createObjectURL(file);
          if (preview) {
            preview.src = url;
            preview.classList.remove('hidden');
          }
          if (noImageLabel) noImageLabel.classList.add('hidden');
        } else {
          // Reset preview if user clears selection
          if (preview) {
            preview.src = '';
            preview.classList.add('hidden');
          }
          if (noImageLabel) noImageLabel.classList.remove('hidden');
        }
      });
    })();
  </script>
</x-app-layout>

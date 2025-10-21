{{-- resources/views/games/show.blade.php --}}
<x-app-layout>
  <div class="max-w-7xl mx-auto px-8 pb-18">
    {{-- Header --}}
    <div class="flex flex-row my-9 items-center justify-between px-6">
      <h2 class="text-white text-3xl font-semibold mb-4 md:mb-0">
        {{ $game->title }}
      </h2>

      <div class="flex flex-col md:flex-row gap-3 w-full md:w-auto">
        {{-- Back to Games --}}
        <a href="{{ route('games.index') }}" class="w-full md:w-auto">
          <button class="w-full md:w-auto bg-white px-6 py-2 rounded-md font-semibold hover:bg-black hover:text-white hover:outline-none hover:ring-2 hover:ring-white hover:ring-offset-2 transition">
            ← Back to Games
          </button>
        </a>
      </div>
    </div>

    {{-- Game info --}}
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 px-6 items-stretch">
      {{-- Cover (square) --}}
      <div class="w-full">
        @if($game->cover_url)
          <div class="w-full aspect-square rounded-md overflow-hidden bg-gray-100">
            <img src="{{ $game->cover_url }}" alt="{{ $game->title }} cover"
                 class="w-full h-full object-cover">
          </div>
        @else
          <div class="w-full aspect-square rounded-md bg-gray-100 flex items-center justify-center text-gray-400">
            No Image
          </div>
        @endif
      </div>

      {{-- Description / Details --}}
      <div class="w-full lg:mt-0">
        <div class="w-full lg:aspect-square">
          <div class="h-full rounded-xl bg-black p-[2px]">
            <div class="h-full bg-white rounded-lg p-6 shadow-sm flex flex-col overflow-hidden">
              <h3 class="text-lg font-semibold text-gray-900 shrink-0">Description</h3>

              <div class="mt-4 space-y-4 grow overflow-auto pr-1">
                <div>
                  <label class="block text-sm font-medium text-gray-900">Title</label>
                  <div class="mt-1 w-full rounded-md border border-black bg-white px-3 py-2">
                    {{ $game->title }}
                  </div>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                  <div>
                    <label class="block text-sm font-medium text-gray-900">Genre</label>
                    <div class="mt-1 w-full rounded-md border border-black bg-white px-3 py-2">
                      {{ $game->genre ?: '—' }}
                    </div>
                  </div>
                  <div>
                    <label class="block text-sm font-medium text-gray-900">Release Year</label>
                    <div class="mt-1 w-full rounded-md border border-black bg-white px-3 py-2">
                      {{ $game->release_year ?: '—' }}
                    </div>
                  </div>
                </div>

                <div>
                  <label class="block text-sm font-medium text-gray-900">Description</label>
                  <div class="mt-1 w-full rounded-md border border-black bg-white px-3 py-2 leading-relaxed min-h-24">
                    {{ $game->description ?: '—' }}
                  </div>
                </div>

                {{-- Average rating --}}
                @php $avg = $game->avgRating(); @endphp
                <div class="space-y-2">
                  <div class="flex items-center justify-between">
                    <p class="font-semibold text-gray-900">Average Rating</p>
                    <p class="text-sm text-gray-600">
                      {{ $avg ? number_format($avg,1) . '/10' : '—' }}
                    </p>
                  </div>
                  <div class="h-2 w-full bg-gray-200 rounded-md overflow-hidden">
                    <div class="h-full bg-black" style="width: {{ $avg ? min(max($avg*10,0),100) : 0 }}%"></div>
                  </div>
                  <div class="flex items-center gap-1">
                    @for ($i = 1; $i <= 10; $i++)
                      <span class="inline-block w-2.5 h-2.5 rounded-full {{ $avg && $i <= round($avg) ? 'bg-black' : 'bg-gray-300' }}"></span>
                    @endfor
                  </div>
                </div>
              </div> {{-- /grow --}}

              {{-- Actions: Edit (primary) + Delete (link-style like Cancel) --}}
              <div class="pt-4 flex items-center gap-3">
                <a href="{{ route('games.edit', $game) }}">
                  <button
                    class="bg-black text-white px-6 py-2 rounded-md font-semibold hover:bg-white hover:text-black hover:ring-2 hover:ring-black hover:ring-offset-2 transition"
                    title="Edit this game"
                  >
                    Edit
                  </button>
                </a>

                <form
                  action="{{ route('games.destroy', $game) }}"
                  method="POST"
                  onsubmit="return confirm('Are you sure you want to delete this game? This action cannot be undone.')" >
                  @csrf
                  @method('DELETE')
                  <button
                    type="submit"
                    class="text-sm underline text-gray-700 hover:text-black"
                    title="Delete this game"
                  >
                    Delete
                  </button>
                </form>
              </div>
              {{-- /Actions --}}
            </div>
          </div>
        </div>
      </div>
    </div>

    {{-- Reviews list --}}
    <div class="flex flex-col md:flex-row my-9 items-start md:items-center justify-between px-6">
      <h2 class="text-white text-2xl font-semibold mb-4 md:mb-0">
        Reviews ({{ $game->reviews->count() }})
      </h2>
    </div>

    <div class="flex flex-col mt-9 items-start justify-between px-6">
      <div class="w-full">
        <div class="rounded-xl bg-black p-[2px]">
          <div class="bg-white rounded-lg p-6 shadow-sm"
               x-data="{ r: {{ old('rating', 0) }} }">
            <form method="POST" action="{{ route('games.reviews.store', $game) }}" class="space-y-5">
              @csrf

              <div>
                <label class="block text-sm font-medium text-gray-900">Name (optional)</label>
                <input name="author" value="{{ old('author') }}"
                       class="mt-1 w-full rounded-md border border-black bg-white focus:border-black focus:ring-black" />
                @error('author') <p class="text-red-600 text-sm mt-1">{{ $message }}</p> @enderror
              </div>

              {{-- Rating 1..10 --}}
              <div>
                <div class="flex items-center justify-between">
                  <label class="block text-sm font-medium text-gray-900">Rating</label>
                  <span class="text-sm text-gray-600" x-text="r ? (r + ' / 10') : '—'"></span>
                </div>

                <input type="hidden" name="rating" :value="r">

                <div class="mt-2 flex items-center gap-2 select-none">
                  <template x-for="n in 10" :key="n">
                    <button type="button"
                            class="w-8 h-8 rounded-md border transition"
                            :class="n <= r ? 'border-black bg-black text-white' : 'border-black bg-white text-black'"
                            @click.prevent="r = n"
                            @keydown.enter.prevent="r = n">
                      <span class="block text-sm font-semibold text-center leading-8" x-text="n"></span>
                    </button>
                  </template>
                </div>
                @error('rating') <p class="text-red-600 text-sm mt-2">{{ $message }}</p> @enderror
              </div>

              <div>
                <label class="block text-sm font-medium text-gray-900">Your review</label>
                <textarea name="body" rows="4"
                          class="mt-1 w-full rounded-md border border-black bg-white focus:border-black focus:ring-black"
                          placeholder="What did you like or dislike?">{{ old('body') }}</textarea>
                @error('body') <p class="text-red-600 text-sm mt-1">{{ $message }}</p> @enderror
              </div>

              <div class="pt-2 flex flex-wrap gap-2">
                <button type="submit"
                        class="px-4 py-2 rounded-md bg-black text-white hover:text-black hover:bg-white hover:ring-2 hover:ring-black ">
                  Submit Review
                </button>
                <a href="{{ route('games.index') }}"
                   class="px-4 py-2 rounded-md border border-black/40 hover:bg-gray-100">
                  Cancel
                </a>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>

    <div class="mt-0 px-6">
      @if($game->reviews->count() === 0)
        <p class="text-gray-300">No reviews yet—be the first!</p>
      @else
        <div class="space-y-4">
          @foreach($game->reviews->sortByDesc('created_at') as $rev)
            <div class="rounded-xl bg-black p-[2px]">
              <div class="bg-white rounded-lg p-4 shadow-sm">
                <div class="flex items-start justify-between gap-4">
                  <div class="flex items-center gap-3">
                    <div class="w-9 h-9 rounded-full bg-black text-white flex items-center justify-center font-semibold">
                      {{ strtoupper(mb_substr($rev->author ?: 'A', 0, 1)) }}
                    </div>
                    <div>
                      <p class="font-medium text-gray-900">{{ $rev->author ?: 'Anonymous' }}</p>
                      <p class="text-xs text-gray-500">{{ $rev->created_at->diffForHumans() }}</p>
                    </div>
                  </div>
                  <span class="inline-flex items-center px-2 py-1 rounded-md text-sm font-semibold
                               {{ $rev->rating >= 8 ? 'bg-emerald-100 text-emerald-700' : ($rev->rating >=5 ? 'bg-amber-100 text-amber-700' : 'bg-rose-100 text-rose-700') }}">
                    {{ $rev->rating }}/10
                  </span>
                </div>
                @if($rev->body)
                  <p class="mt-3 text-gray-800 leading-relaxed">{{ $rev->body }}</p>
                @endif
              </div>
            </div>
          @endforeach
        </div>
      @endif
    </div>
  </div>
</x-app-layout>

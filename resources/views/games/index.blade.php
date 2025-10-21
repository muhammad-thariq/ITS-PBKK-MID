<x-app-layout>

  <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

    <div class="flex flex-col md:flex-row my-9 items-start md:items-center justify-between px-6">
      <h2 class="text-white text-3xl font-semibold mb-4 md:mb-0">List of Games</h2>
    
      <div class="flex flex-col md:flex-row gap-4 w-full md:w-auto">
        <a href="{{ route('games.create') }}" class="w-full md:w-auto">
          <button class="bg-white px-10 py-2 rounded-md font-semibold hover:bg-black hover:text-white hover:outline-none hover:ring-2 hover:ring-white hover:ring-offset-2 transition ease-in-out duration-150 w-full md:w-auto text-center">+ Add Game</button>
        </a>
      </div>
      
    </div>

    <div class="grid md:grid-cols-3 grid-cols-1 mt-4 gap-6 px-6">  
      @foreach($games as $game)
      <div>
        <img src="{{ $game->cover_url }}" class="rounded-md w-[390px] h-[390px] object-cover">

        <div class="my-2">
          <p class="text-xl text-white font-semibold">
            {{ $game->title}}
          </p>
          <p class="text-gray-400">
            {{ $game->genre ? $game->genre.' • ' : '' }}{{ $game->release_year ?? '—' }}
          </p>
          <a href="{{ route('games.show', $game) }}">
            <button class="bg-white px-10 py-2 w-full rounded-md font-semibold my-4 hover:bg-black hover:text-white hover:outline-none hover:ring-2 hover:ring-white hover:ring-offset-2 transition">
              + Add Reviews
            </button>
          </a>
        </div>
      </div>
      @endforeach
    </div>

</x-app-layout>
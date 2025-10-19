@extends('layout')

@section('content')
  <h1 class="text-2xl font-bold mb-4">Games</h1>

  <!-- Search form (GET) -->
  <form method="GET" action="{{ route('games.index') }}" class="mb-4 flex gap-2">
    <input type="text" name="q" value="{{ $q }}" placeholder="Search by title..."
           class="w-full rounded-md border-gray-300 focus:border-indigo-500 focus:ring-indigo-500">
    <button class="px-4 py-2 rounded-md border border-gray-300 hover:bg-gray-100">Search</button>
  </form>

  <div class="bg-white rounded-lg border">
    <table class="min-w-full divide-y divide-gray-200">
      <thead class="bg-gray-50">
        <tr>
          <th class="px-4 py-2 text-left text-sm font-semibold">Cover</th> {{-- ⬅ NEW --}}
          <th class="px-4 py-2 text-left text-sm font-semibold">Title</th>
          <th class="px-4 py-2 text-left text-sm font-semibold">Genre</th>
          <th class="px-4 py-2 text-left text-sm font-semibold">Year</th>
          <th class="px-4 py-2 text-left text-sm font-semibold">Avg Rating</th>
          <th class="px-4 py-2"></th>
        </tr>
      </thead>
      <tbody class="divide-y divide-gray-100">
        @forelse($games as $g)
          <tr>
            <td class="px-4 py-2">
              @if($g->cover_url)
                <img src="{{ $g->cover_url }}" alt="thumb" class="h-12 w-12 object-cover rounded-md border">
              @else
                <div class="h-12 w-12 rounded-md border flex items-center justify-center text-xs text-gray-500">No img</div>
              @endif
            </td>
            <td class="px-4 py-2">
              <a href="{{ route('games.show', $g) }}" class="text-indigo-600 hover:underline">{{ $g->title }}</a>
            </td>
            <td class="px-4 py-2">{{ $g->genre ?? '—' }}</td>
            <td class="px-4 py-2">{{ $g->release_year ?? '—' }}</td>
            <td class="px-4 py-2">
              @php $avg = $g->reviews->count() ? round($g->reviews->avg('rating'),1) : null; @endphp
              {{ $avg ?? '—' }}
            </td>
            <td class="px-4 py-2 text-right">
              <a href="{{ route('games.edit', $g) }}" class="px-3 py-1 rounded-md border hover:bg-gray-100">Edit</a>
              <form action="{{ route('games.destroy',$g) }}" method="POST" class="inline">
                @csrf @method('DELETE')
                <button onclick="return confirm('Delete this game?')"
                        class="px-3 py-1 rounded-md border hover:bg-gray-100">Delete</button>
              </form>
            </td>
          </tr>
        @empty
          <tr><td class="px-4 py-3" colspan="6">No games found.</td></tr>
        @endforelse
      </tbody>
    </table>
  </div>

  <div class="mt-4">{{ $games->links() }}</div>
@endsection

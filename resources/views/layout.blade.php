<!doctype html>
<html lang="en" class="h-full bg-gray-50">
<head>
  <meta charset="utf-8">
  <title>{{ $title ?? 'Game Review' }}</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  @vite(['resources/css/app.css','resources/js/app.js'])
</head>
<body class="min-h-full text-gray-900">
  <div class="max-w-4xl mx-auto p-6">
    <nav class="mb-6 flex items-center justify-between">
      <a href="{{ route('games.index') }}" class="text-xl font-semibold">🎮 Game Review</a>
      <a href="{{ route('games.create') }}" class="px-3 py-2 rounded-md bg-indigo-600 text-white hover:bg-indigo-700">+ New Game</a>
    </nav>

    @if(session('ok'))
      <div class="mb-4 rounded-md border border-emerald-300 bg-emerald-50 px-4 py-3 text-emerald-800">
        {{ session('ok') }}
      </div>
    @endif

    @yield('content')
  </div>
</body>
</html>

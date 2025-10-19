<?php

namespace App\Http\Controllers;

use App\Models\Game;
use Illuminate\Http\Request;

class GameController extends Controller
{
    public function index(Request $request)
    {
        $q = $request->query('q');

        $games = Game::with('reviews')
            ->search($q)
            ->latest()
            ->paginate(10)
            ->withQueryString();

        return view('games.index', compact('games', 'q'));
    }

    public function create()
    {
        return view('games.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'title'        => ['required', 'string', 'max:255'],
            'genre'        => ['nullable', 'string', 'max:100'],
            'release_year' => ['nullable', 'integer', 'between:1970,2100'],
            'description'  => ['nullable', 'string'],
        ]);

        Game::create($data);

        return redirect()->route('games.index')->with('ok', 'Game created.');
    }

    public function show(Game $game)
    {
        $game->load('reviews'); // needed for avg & listing
        return view('games.show', compact('game'));
    }

    public function edit(Game $game)
    {
        return view('games.edit', compact('game'));
    }

    public function update(Request $request, Game $game)
    {
        $data = $request->validate([
            'title'        => ['required', 'string', 'max:255'],
            'genre'        => ['nullable', 'string', 'max:100'],
            'release_year' => ['nullable', 'integer', 'between:1970,2100'],
            'description'  => ['nullable', 'string'],
        ]);

        $game->update($data);

        return redirect()->route('games.show', $game)->with('ok', 'Game updated.');
    }

    public function destroy(Game $game)
    {
        $game->delete();
        return redirect()->route('games.index')->with('ok', 'Game deleted.');
    }
}

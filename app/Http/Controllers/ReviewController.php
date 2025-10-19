<?php

namespace App\Http\Controllers;

use App\Models\Game;
use App\Models\Review;
use Illuminate\Http\Request;

class ReviewController extends Controller
{
    public function store(Request $request, Game $game)
    {
        $data = $request->validate([
            'author' => ['nullable','string','max:100'],
            'rating' => ['required','integer','between:1,10'],
            'body'   => ['nullable','string'],
        ]);

        $data['game_id'] = $game->id;
        Review::create($data);

        return back()->with('ok', 'Review added.');
    }
}

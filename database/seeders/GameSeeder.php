<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class GameSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        \App\Models\Game::factory()
            ->count(8)
            ->create()
            ->each(function ($game) {
                \App\Models\Review::factory()
                    ->count(rand(0,3))
                    ->create(['game_id' => $game->id]);
            });
    }

}

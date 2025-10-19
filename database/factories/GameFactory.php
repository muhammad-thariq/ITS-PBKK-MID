<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Game>
 */
class GameFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'title'        => fake()->unique()->words(3, true),
            'genre'        => fake()->randomElement(['Action','RPG','Strategy','Adventure','Indie']),
            'release_year' => fake()->numberBetween(2005, 2025),
            'description'  => fake()->sentence(12),
        ];
    }

}

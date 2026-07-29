<?php

namespace Database\Factories;

use App\Models\Comment;
use App\Models\Story;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Comment>
 */
class CommentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user' => fake()->name(),
            'body' => fake()->text(),
            'story_id' => Story::inRandomOrder()->first()->id,          //we had created Story using seed, how to use the created story_id here
        ];
    }
}

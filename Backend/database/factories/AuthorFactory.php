<?php

namespace Database\Factories;

use App\Models\Author;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Author>
 */
class AuthorFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        // no need to include id and timestamp as it is automatically generated
        
        return [
            'name' =>   fake()->name(),
            'bio' => fake()->optional()->paragraph()
        ];
    }
}

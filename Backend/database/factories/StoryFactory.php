<?php

namespace Database\Factories;

use App\Models\Story;
use App\Models\Category;
use App\Models\Author;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends Factory<Story>
 */
class StoryFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $title = fake()->sentence(6);

        return [
            'title'          => $title,
            'slug'           => Str::slug($title) . '-' . fake()->unique()->numberBetween(1000, 999999),
            'image' => 'https://picsum.photos/seed/' . Str::random(10) . '/640/480',
            'category_id'    => Category::inRandomOrder()->first()?->id,
            'date_published' => fake()->dateTimeBetween('-1 year', 'now'),
//            'comment_count'  => fake()->numberBetween(0, 100), // should be based on Comment table
            'language'       => fake()->randomElement(['en', 'ms', 'zh']),
            'link'           => fake()->unique()->url(),
            'summary'        => fake()->paragraph(2),
            'author_id'      => fake()->boolean(70) ? Author::inRandomOrder()->first()?->id : null,
            // only 70% of stories generated attach to existing author, others are null author
            'full_story'     => fake()->paragraphs(5, true),
        ];
    }
}

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
            'image'          => fake()->imageUrl(640, 480, 'news', true),
            'category_id'    => Category::inRandomOrder()->first()?->id ?? Category::factory(),
            // explain this
            'date_published' => fake()->dateTimeBetween('-1 year', 'now'),
            'comment_count'  => fake()->numberBetween(0, 100),
            'language'       => fake()->randomElement(['en', 'ms', 'zh']),
            'link'           => fake()->url() . '?id=' . fake()->unique()->uuid(),
            'summary'        => fake()->paragraph(2),
            'author_id'      => Author::factory(), // Automatically creates or attaches an Author
            'full_story'     => fake()->paragraphs(5, true),
        ];
    }
}

<?php

namespace Database\Factories;

use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends Factory<Category>
 */
class CategoryFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
        {
        $categories = [
            'News'     => 'Breaking news and current affairs from around Malaysia.',
            'Columns' => 'In-depth analysis and commentary from columnists and contributors.',
            'Letters'  => 'Letters submitted by readers on issues that matter to them.',
            'Yoursay'  => 'Reader-submitted reactions and opinions on the day\'s top stories.',
        ];

        static $index = 0;
        $names = array_keys($categories);
        $name = $names[$index % count($names)];
        $index++;

        return [
            'name'        => $name,
            'slug'        => Str::slug($name),
            'description' => $categories[$name],
        ];
    }
}

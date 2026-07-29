<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Author;
use App\Models\Category;
use App\Models\Tag;
use App\Models\Story;
use App\Models\Comment;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {

         Author::factory(8)->create();

         Category::factory(4)->create();

         Tag::factory(10)->create();

         $stories = Story::factory(30)->create();

         $stories->each(function ($story){
             // Attach random tag (many-yo-many)
             $story->tags()->attach(
                 Tag::inRandomOrder()->take(rand(1,4))->pluck('id')
             );

             //Create comments for each story
             Comment::factory(rand(0,6))->create([
                 'story_id' => $story->id,
             ]);
         });
    }
}

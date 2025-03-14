<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Post;
use App\Models\Category;
use App\Models\User;
use App\Models\Tag;
use Illuminate\Support\Str;

class PostSeeder extends Seeder
{
    public function run()
    {
        $categories = Category::all();
        $user = User::first(); // Assuming first user exists
        $tags = Tag::all();

        for ($i = 0; $i < 10; $i++) {
            $post = Post::create([
                'title' => 'Post Title ' . ($i + 1),
                'slug' => Str::slug('Post Title ' . ($i + 1)) . '-' . uniqid(),
                'content' => 'This is the content of post ' . ($i + 1),
                'category_id' => $categories->random()->id,
                'user_id' => $user->id,
            ]);

            $post->tags()->attach($tags->random(3)->pluck('id'));
        }
    }
}

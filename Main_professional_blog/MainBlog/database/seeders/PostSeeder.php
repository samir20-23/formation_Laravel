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
        // Fetch all categories and tags
        $categories = Category::all();
        $user = User::all();
        $tags = Tag::all();

        // Seed 10 posts
        for ($i = 0; $i < 10; $i++) {
            // Create a new post
            $post = Post::create([
                'title' => 'Post Title ' . ($i + 1),
                'slug' => Str::slug('Post Title ' . ($i + 1)),  // Generate slug from title
                'content' => 'This is the content of post ' . ($i + 1),
                'category_id' => $categories->random()->id,  // Random category
                'user_id' => 1,  // Assuming user ID 1 (admin or first user)
            ]);

            $post->tags()->attach($tags->random(3)->pluck('id'));
        }
        $post = Post::create([
            'title' => 'Post Title @',
            'slug' => Str::slug('Post Title @'),  // Generate slug from title
            'content' => 'This is the content of post @ ',
            'category_id' => $user->random()->id,  // Random category
            'user_id' => 2,
        ]);
        $post = Post::create([
            'title' => 'Post Title #',
            'slug' => Str::slug('Post Title #'),  // Generate slug from title
            'content' => 'This is the content of post #',
            'category_id' => $user->random()->id,  // Random category
            'user_id' => 3,
        ]);
    }
}

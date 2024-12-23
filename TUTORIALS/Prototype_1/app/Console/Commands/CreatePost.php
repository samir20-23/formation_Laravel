<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Category;
use App\Models\Post;

class CreatePost extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:create-post';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a new post with an existing or new category';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $title = $this->ask('Enter the post title');
        $body = $this->ask('Enter the post body');

        $categories = Category::pluck('name')->toArray();

        if (!empty($categories)) {
            $categoryName = $this->choice('Select a category or type a new category name', array_merge($categories, ['Add New Category']));
        } else {
            $this->info("No categories available. You need to add a new category.");
            $categoryName = $this->ask('Enter the category name');
        }

        if ($categoryName === 'Add New Category') {
            $categoryName = $this->ask('Enter the new category name');
        }

        $category = Category::firstOrCreate(['name' => $categoryName]);

        $post = new Post(['title' => $title, 'body' => $body]);
        $category->posts()->save($post);

        $this->info("Post '{$title}' created successfully in category '{$category->name}'.");
    }
}

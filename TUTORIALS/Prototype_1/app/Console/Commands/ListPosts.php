<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Post;

class ListPosts extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:list-posts';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $posts = Post::with('category')->get();

        foreach ($posts as $post) {
            $this->info("Title: {$post->title}");
            $this->line("Body: {$post->body}");
            $this->line("Category: {$post->category->name}");
            $this->line('---');
        }
    }
}

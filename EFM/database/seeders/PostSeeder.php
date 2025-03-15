<?php
namespace Database\Seeders;
use App\Models\Post;
use Illuminate\Database\Seeder;
class PostSeeder extends Seeder {
    public function run() {
        Post::create(['title'=>'🔥 First Post','content'=>'🚩 Content of first post']);
        Post::create(['title'=>'💻 Second Post','content'=>'❤ Content of second post']);
    }
}
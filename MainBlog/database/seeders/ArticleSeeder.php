<?php

namespace Database\Seeders;

use App\Models\Article;
use App\Models\Category;
use Illuminate\Database\Seeder;

class ArticleSeeder extends Seeder
{
    public function run()
    {
        $techCategory = Category::where('name', 'Technology')->first();
        $healthCategory = Category::where('name', 'Health')->first();

        Article::create([
            'title' => 'Tech Article 1',
            'content' => 'Content of the technology article.',
            'category_id' => $techCategory->id,
        ]);

        Article::create([
            'title' => 'Health Article 1',
            'content' => 'Content of the health article.',
            'category_id' => $healthCategory->id,
        ]);
    }
}


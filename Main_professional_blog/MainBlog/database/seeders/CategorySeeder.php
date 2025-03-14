<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;
use Illuminate\Support\Str;

class CategorySeeder extends Seeder
{
    public function run()
    {
        // Example categories
        $categories = ['Tech', 'Web Development', 'Mobile Development', 'Design', 'SEO'];

        foreach ($categories as $category) {
            Category::create([
                'name' => $category,
                'slug' => Str::slug($category),  // Generate a slug from the name
            ]);
        }
    }
}

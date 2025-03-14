<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Tag;

class TagSeeder extends Seeder
{
    public function run()
    {
        // Example tags
        $tags = ['Laravel', 'PHP', 'JavaScript', 'Vue.js', 'React', 'CSS', 'MySQL'];

        foreach ($tags as $tag) {
            Tag::create([
                'name' => $tag,
            ]);
        }
    }
}

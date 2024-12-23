<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use League\Csv\Reader;

use App\Models\Post;

class PostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::transaction(function () {
            $csv = Reader::createFromPath(database_path('seeders/posts.csv'), 'r');
            $csv->setHeaderOffset(0);

            foreach ($csv as $record) {
                Post::create([
                    'title' => $record['title'],
                    'body' => $record['body'],
                    'category_id' => $record['category_id'],
                ]);
            }
        });
    }
}

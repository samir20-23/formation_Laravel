<?php

namespace App\Services;

use App\Models\Post;
use Illuminate\Support\Facades\DB;

class PostService
{
    public function createPost(array $data)
    {
        return DB::transaction(function () use ($data) {
            $post = Post::create($data);
            if (isset($data['tags'])) {
                $post->tags()->attach($data['tags']);
            }
            return $post;
        });
    }

    public function updatePost(Post $post, array $data)
    {
        return DB::transaction(function () use ($post, $data) {
            $post->update($data);
            if (isset($data['tags'])) {
                $post->tags()->sync($data['tags']);
            }
            return $post;
        });
    }

    public function deletePost(Post $post)
    {
        return $post->delete();
    }
}

<?php 
namespace App\Services;

use App\Models\Post;
use Illuminate\Support\Facades\Auth;

class PostService
{
    // Get all posts with pagination
    public function getAllPosts($perPage = 10)
    {
        return Post::with(['category', 'tags', 'user'])->latest()->paginate($perPage);
    }

    // Create a new post
    public function createPost(array $data)
    {
        $data['user_id'] = Auth::id();
        return Post::create($data);
    }

    // Update an existing post
    public function updatePost(Post $post, array $data)
    {
        return $post->update($data);
    }

    // Delete a post
    public function deletePost(Post $post)
    {
        return $post->delete();
    }
}

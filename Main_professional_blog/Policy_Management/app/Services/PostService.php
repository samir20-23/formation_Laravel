<?php 
namespace App\Services;

use App\Models\Post;
use Illuminate\Support\Facades\Auth;

class PostService
{
    // Get all posts with pagination
    public function getAllPosts()
    {
        // Eager load the category and tags relationships to avoid lazy loading issues
        return Post::with(['category', 'tags'])->get();
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

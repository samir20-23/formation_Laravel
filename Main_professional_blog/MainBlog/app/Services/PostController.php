<?php 
namespace App\Http\Controllers;

use App\Services\PostService;
use Illuminate\Http\Request;
use App\Models\Post;

class PostController extends Controller
{
    protected $postService;

    public function __construct(PostService $postService)
    {
        $this->postService = $postService;
    }

    public function index()
    {
        $posts = $this->postService->getAllPosts();
        return view('posts.index', compact('posts'));
    }

    public function store(Request $request)
    {
        $post = $this->postService->createPost($request->all());
        return redirect()->route('posts.index')->with('success', 'Post created successfully!');
    }

    public function update(Request $request, Post $post)
    {
        $this->postService->updatePost($post, $request->all());
        return redirect()->route('posts.index')->with('success', 'Post updated successfully!');
    }

    public function destroy(Post $post)
    {
        $this->postService->deletePost($post);
        return redirect()->route('posts.index')->with('success', 'Post deleted successfully!');
    }
}

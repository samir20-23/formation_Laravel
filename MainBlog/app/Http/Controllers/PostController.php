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

    // Display all posts
    public function index()
    {
        $posts = $this->postService->getAllPosts();
        return view('posts.index', compact('posts'));
    }

    // Show form to create a post
    public function create()
    {
        return view('posts.create');
    }

    // Store a new post
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required',
            'category_id' => 'required|exists:categories,id',
        ]);

        $this->postService->createPost($request->all());

        return redirect()->route('posts.index')->with('success', 'Post created successfully!');
    }

    // Show a single post
    public function show(Post $post)
    {
        return view('posts.show', compact('post'));
    }

    // Show form to edit a post
    public function edit(Post $post)
    {
        return view('posts.edit', compact('post'));
    }

    // Update an existing post
    public function update(Request $request, Post $post)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required',
            'category_id' => 'required|exists:categories,id',
        ]);

        $this->postService->updatePost($post, $request->all());

        return redirect()->route('posts.index')->with('success', 'Post updated successfully!');
    }

    // Delete a post
    public function destroy(Post $post)
    {
        $this->postService->deletePost($post);
        return redirect()->route('posts.index')->with('success', 'Post deleted successfully!');
    }
}

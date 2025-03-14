<?php

namespace App\Http\Controllers;

use App\Services\PostService;
use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\Category;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests; //++++++++ add this line


class PostController extends Controller
{
    use AuthorizesRequests;
    
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
        $categories = Category::all();
        $this->authorize('create', Post::class); //++++++++ Added authorization check for creating a post
        return view('posts.create', compact('categories'));
    }

    // Show form to edit a post
    public function edit($id)
    {
        $post = Post::findOrFail($id);
        $categories = Category::all();
        $this->authorize('update', $post); //++++++++ Added authorization check for editing a post
        return view('posts.edit', compact('post', 'categories'));
    }

    // Store a new post
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required',
            'category_id' => 'required|exists:categories,id',
        ]);

        $this->authorize('create', Post::class); //++++++++ Added authorization check for storing a post

        $this->postService->createPost($request->all());

        return redirect()->route('posts.index')->with('success', 'Post created successfully!');
    }

    // Show a single post
    public function show(Post $post)
    {
        return view('posts.show', compact('post'));
    }

    // Update an existing post
    public function update(Request $request, Post $post)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required',
            'category_id' => 'required|exists:categories,id',
        ]);

        $this->authorize('update', $post); //++++++++ Added authorization check for updating a post

        $this->postService->updatePost($post, $request->all());

        return redirect()->route('posts.index')->with('success', 'Post updated successfully!');
    }

    // Delete a post
    public function destroy(Post $post)
    {
        $this->authorize('delete', $post); //++++++++ Added authorization check for deleting a post

        $this->postService->deletePost($post);

        return redirect()->route('posts.index')->with('success', 'Post deleted successfully!');
    }
}

<?php

namespace App\Http\Controllers;

use App\Services\PostService;
use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\Category;
use App\Models\Tag;
use App\Http\Requests\PostRequest;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

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
        // Eager load the category and tags relationships
        $posts = Post::with(['category', 'tags'])->get();
        return view('posts.index', compact('posts'));
    }

    // Show a single post
    public function show(Post $post)
    {
        return view('posts.show', compact('post'));
    }

    // Show the form to create a new post
    public function create()
    {
        $this->authorize('create', Post::class); // Only allow if authorized
        $categories = Category::all();
        return view('posts.create', compact('categories'));
    }

    // Store a new post
    public function store(PostRequest $request)
    {
        $this->authorize('create', Post::class); 
        $post = Post::create($request->validated());
        $post->tags()->attach($request->tags); 
        return redirect()->route('posts.index');
    }
    // Show the form to edit a post
    public function edit(Post $post)
    {
        $this->authorize('update', $post); // Only allow if authorized
        $categories = Category::all();
        return view('posts.edit', compact('post', 'categories'));
    }

    // Update the post
    public function update(PostRequest $request, Post $post)
    {
        $this->authorize('update', $post);

        $post->update($request->validated());
        $post->tags()->sync($request->tags);

        return redirect()->route('posts.index');
    }
    // Delete the post
    public function destroy(Post $post)
    {
        $this->authorize('delete', $post);
        $post->delete();
        return redirect()->route('posts.index');
    }
}

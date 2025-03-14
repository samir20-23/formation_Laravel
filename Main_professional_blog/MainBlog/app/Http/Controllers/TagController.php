<?php
namespace App\Http\Controllers;

use App\Services\TagService;
use Illuminate\Http\Request;
use App\Models\Tag;

class TagController extends Controller
{
    protected $tagService;

    public function __construct(TagService $tagService)
    {
        $this->tagService = $tagService;
    }

    // Display all tags
    public function index()
    {
        $tags = $this->tagService->getAllTags();
        return view('tags.index', compact('tags'));
    }

    // Show form to create a tag
    public function create()
    {
        return view('tags.create');
    }

    // Store a new tag
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:tags',
        ]);

        $this->tagService->createTag($request->all());

        return redirect()->route('tags.index')->with('success', 'Tag created successfully!');
    }

    // Show form to edit a tag
    public function edit(Tag $tag)
    {
        return view('tags.edit', compact('tag'));
    }

    // Update an existing tag
    public function update(Request $request, Tag $tag)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:tags,name,' . $tag->id,
        ]);

        $this->tagService->updateTag($tag, $request->all());

        return redirect()->route('tags.index')->with('success', 'Tag updated successfully!');
    }

    // Delete a tag
    public function destroy(Tag $tag)
    {
        $this->tagService->deleteTag($tag);
        return redirect()->route('tags.index')->with('success', 'Tag deleted successfully!');
    }
}

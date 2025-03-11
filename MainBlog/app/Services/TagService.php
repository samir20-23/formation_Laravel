<?php 
namespace App\Services;

use App\Models\Tag;

class TagService
{
    // Get all tags
    public function getAllTags()
    {
        return Tag::all();
    }

    // Create a new tag
    public function createTag(array $data)
    {
        return Tag::create($data);
    }

    // Update an existing tag
    public function updateTag(Tag $tag, array $data)
    {
        return $tag->update($data);
    }

    // Delete a tag
    public function deleteTag(Tag $tag)
    {
        return $tag->delete();
    }
}

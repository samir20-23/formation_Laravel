<?php 
namespace App\Services;

use App\Models\Tag;

class TagService
{
    public function getAllTags()
    {
        return Tag::all();
    }

    public function createTag($data)
    {
        return Tag::create($data);
    }

    public function updateTag(Tag $tag, $data)
    {
        return $tag->update($data);
    }

    public function deleteTag(Tag $tag)
    {
        return $tag->delete();
    }
}

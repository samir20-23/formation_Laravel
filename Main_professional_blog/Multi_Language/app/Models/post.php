<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'content', 'user_id', 'category_id'];

    // A post belongs to one category
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    // A post belongs to one user (author)
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // A post can have many tags (Many-to-Many)
    public function tags()
    {
        return $this->belongsToMany(Tag::class, 'post_tag');
    }
}

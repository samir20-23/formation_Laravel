<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
 

class Article extends Model
{
    public function comments()
    {
        return $this->morphMany(Comment::class, 'commentable');
    }
}

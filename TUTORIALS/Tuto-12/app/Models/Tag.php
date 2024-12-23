<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    protected $fillable = ['name'];

    public function articles() {
        return $this->belongsToMany(Article::class,'article_tag')->withPivot('description');;
    }

    public function comments() {
        return $this->morphMany(Comment::class, 'commentable');
    }
}

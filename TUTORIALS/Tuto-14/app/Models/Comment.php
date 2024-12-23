<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    protected $fillable = ['content'];

    public function commentable()
    {
        return $this->morphTo(); // Defines the polymorphic relationship for this model.
    }

    public function latestComments() {
        return $this->comments()->latest();
    }
}

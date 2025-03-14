<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Post;
use Illuminate\Auth\Access\HandlesAuthorization;

class PostPolicy
{
    use HandlesAuthorization;

    /**
     * Determine if the user can create posts.
     */
    public function create(User $user)
    {
        return $user->hasRole('admin'); // Only admin users can create posts
    }

    /**
     * Determine if the user can update the post.
     */
    public function update(User $user, Post $post)
    {
        return $user->hasRole('admin') || $user->id === $post->user_id; // Admins and owners can update
    }

    /**
     * Determine if the user can delete the post.
     */
    public function delete(User $user, Post $post)
    {
        return $user->hasRole('reader') ; // Admins and owners can delete
    }
}

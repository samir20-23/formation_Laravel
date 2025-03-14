<?php

namespace App\Policies;

use App\Models\Post;
use App\Models\User;
use Illuminate\Auth\Access\Response; 

class PostPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return false;
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Post $post): bool
    {
        return false;
    }

    /**
     * Determine whether the user can create models.
     */

    // PostPolicy.php
    public function create(User $user)
    {
        return $user->role === 'admin'; // Only 'admin' can create posts
    }
    
    public function update(User $user, Post $post)
    {
        return $user->id === $post->user_id ; // Admin can update any post
    }
    
    public function delete(User $user, Post $post)
    {
        return $user->id === $post->user_id ; // Admin can delete any post
    }
    

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, Post $post): bool
    {
        return false;
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, Post $post): bool
    {
        return false;
    }
}

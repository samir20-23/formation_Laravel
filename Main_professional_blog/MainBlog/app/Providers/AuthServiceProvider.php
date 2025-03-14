<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as BaseAuthServiceProvider; 
use App\Models\Post;
use App\Policies\PostPolicy;

class AuthServiceProvider extends BaseAuthServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        Post::class => PostPolicy::class, // Correct case for Post
    ];

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        $this->registerPolicies();  // This now calls the method from the parent class
    }
}

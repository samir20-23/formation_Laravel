<?php
namespace App\Providers;
use Illuminate\Support\ServiceProvider;
use App\Repositories\PostRepositoryInterface;
use App\Repositories\PostRepository;
class ModuleServiceProvider extends ServiceProvider {
    public function register() {
        $this->app->bind(PostRepositoryInterface::class, PostRepository::class);
    }
    public function boot() {
    }
}
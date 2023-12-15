<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Repositories\Contracts\{
    IUser,
    IBlog,
};
use App\Repositories\Eloquent\{
    UserRepository,
    BlogPostRepository
};

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        $this->app->bind(IUser::class, UserRepository::class);
        $this->app->bind(IBlog::class, BlogPostRepository::class);
    }
}

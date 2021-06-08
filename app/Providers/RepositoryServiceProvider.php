<?php

namespace App\Providers;

use App\Repositories\EloquentRepositoryInterface;
use App\Repositories\PostRepositoryInterface;

use App\Repositories\Eloquent\BaseEloquentRepository;
use App\Repositories\Eloquent\PostRepository;

use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(EloquentRepositoryInterface::class, BaseEloquentRepository::class);
        $this->app->bind(PostRepositoryInterface::class, PostRepository::class);
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}

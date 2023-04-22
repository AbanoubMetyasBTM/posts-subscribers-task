<?php

namespace App\Providers;

use App\Services\Implementation\PostsService;
use App\Services\Implementation\UserService;
use App\Services\Implementation\WebsiteService;
use App\Services\IPostsService;
use App\Services\IUserService;
use App\Services\IWebsiteService;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {

        $this->app->bind(IWebsiteService::class, WebsiteService::class);
        $this->app->bind(IUserService::class, UserService::class);
        $this->app->bind(IPostsService::class, PostsService::class);

    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}

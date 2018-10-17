<?php

namespace Core\Providers;

use Illuminate\Support\ServiceProvider;
use Core\Repositories\UserRepository;
use Core\Repositories\UserRepositoryInterface;
use Core\Services\UserService;
use Core\Services\UserServiceInterface;

class CoreServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
        $this->app->bind(UserRepositoryInterface::class, UserRepository::class);
        $this->app->bind(UserServiceInterface::class, UserService::class);
    }
}

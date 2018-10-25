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
        $this->app->bind(
            RepositoryInterface::class, 
            UserRepository::class, 
            UserDetailRepository::class,
            HotelRepository::class,
            GuideRepository::class,
            TypeTourRepository::class,
            ReviewRepository::class,
            FormalityRepository::class,
            TourRepository::class
        );
        $this->app->bind(
            ServiceInterface::class, 
            UserService::class,
            UserDetailService::class,
            HotelService::class,
            GuideService::class,
            TypeTourService::class,
            ReviewService::class,
            FormalityService::class,
            TourService::class
        );
    }
}

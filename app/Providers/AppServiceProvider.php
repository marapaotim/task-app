<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $toBind = [
            \App\Services\Contracts\UserServiceInterface::class => \App\Services\UserService::class,
            \App\Services\Contracts\TaskServiceInterface::class => \App\Services\TaskService::class
        ];

        foreach ($toBind as $interface => $implementation) {
            $this->app->bind($interface, $implementation);
        }

        $repositoriesToBind = [
            \App\Repositories\Contracts\UserRepositoryInterface::class => \App\Repositories\UserRepository::class,
            \App\Repositories\Contracts\TaskRepositoryInterface::class => \App\Repositories\TaskRepository::class
        ];

        foreach ($repositoriesToBind as $interface => $implementation) {
            $this->app->bind($interface, $implementation);
        }
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}

<?php

namespace App\Providers;

use App\Services\Impl\UserServiceImpl;
use app\Services\TodoListService;
use App\Services\UserService;
use Illuminate\Contracts\Support\DeferrableProvider;
use Illuminate\Support\ServiceProvider;

class TodoListServiceProvider extends ServiceProvider implements DeferrableProvider
{   
    public array $singletons = [
        UserService::class => UserServiceImpl::class
    ];

    public function provides():array
    {
        return [TodoListService::class];
    }

    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
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

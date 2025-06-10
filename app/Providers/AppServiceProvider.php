<?php

namespace App\Providers;

use App\Repositories\UrlRepositoryEloquent;
use App\Repositories\UrlRepositoryInterface;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(
            UrlRepositoryInterface::class,
            UrlRepositoryEloquent::class
        );
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}

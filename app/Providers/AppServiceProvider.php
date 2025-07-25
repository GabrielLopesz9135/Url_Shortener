<?php

namespace App\Providers;

use App\Repositories\UrlRepositoryEloquent;
use App\Repositories\UrlRepositoryInterface;
use App\Repositories\VerifyEmailRepositoryInterface;
use App\Repositories\VerifyEmailRepositoryEloquent;
use App\Repositories\PasswordRepositoryInterface;
use App\Repositories\PasswordRepositoryEloquent;
use App\Repositories\PublicUrlRepositoryInterface;
use App\Repositories\PublicUrlRepositoryEloquent;
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
        $this->app->bind(
            VerifyEmailRepositoryInterface::class,
            VerifyEmailRepositoryEloquent::class
        );
        $this->app->bind(
            PasswordRepositoryInterface::class,
            PasswordRepositoryEloquent::class
        );
        $this->app->bind(
            PublicUrlRepositoryInterface::class,
            PublicUrlRepositoryEloquent::class
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

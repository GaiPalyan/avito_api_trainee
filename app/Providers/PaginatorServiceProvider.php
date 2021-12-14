<?php

namespace App\Providers;

use App\Domain\PaginatorInterface;
use App\Repository\Paginator;
use Illuminate\Support\ServiceProvider;

class PaginatorServiceProvider extends ServiceProvider
{
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
        $this->app->bind(PaginatorInterface::class, Paginator::class);
    }
}

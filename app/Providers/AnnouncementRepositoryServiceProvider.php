<?php

namespace App\Providers;

use App\Domain\AnnouncementRepositoryInterface;
use App\Repository\AnnouncementRepository;
use Illuminate\Support\ServiceProvider;

class AnnouncementRepositoryServiceProvider extends ServiceProvider
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
        $this->app->bind(AnnouncementRepositoryInterface::class, AnnouncementRepository::class);
    }
}

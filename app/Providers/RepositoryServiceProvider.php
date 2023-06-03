<?php

namespace App\Providers;

use App\Repositories\Interfaces\WeatherRepositoryInterface;
use Illuminate\Support\ServiceProvider;
use App\Repositories\Eloquent\WeatherRepository;

class RepositoryServiceProvider extends ServiceProvider
{

    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(BaseRepositoryInterface::class, BaseRepository::class);
        $this->app->bind(WeatherRepositoryInterface::class, WeatherRepository::class);
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

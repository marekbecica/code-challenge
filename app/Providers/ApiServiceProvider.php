<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Services\Spotify;

class ApiServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton(Spotify::class, function () {
           return new Spotify(config('services.spotify.id'), config('services.spotify.secret'));
        });
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

<?php

namespace Ronscript\Geos;

use Illuminate\Support\ServiceProvider;

class GeosServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        $this->publishes([
            __DIR__.'/data/PH.txt' => storage_path('app/public/geos'),
            __DIR__.'/data/readme.txt' => storage_path('app/public/geos')
        ], 'geos');
    }

    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind('geos', Core\Geos::class);
    }
}

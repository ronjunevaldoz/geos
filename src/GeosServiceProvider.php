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
        //
    }

    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind('geos', 'Ronscript\Geos\Core\Geos' );
    }
}

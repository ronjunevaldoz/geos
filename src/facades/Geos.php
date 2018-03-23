<?php

namespace Ronscript\Geos\Facades;

use Illuminate\Support\Facades\Facade;

class Geos extends Facade {
  /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor() { return 'geos'; }
}
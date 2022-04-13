<?php

namespace EdgarOrozco\Versiones\Facades;

use Illuminate\Support\Facades\Facade;

class Versiones extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'versiones';
    }
}

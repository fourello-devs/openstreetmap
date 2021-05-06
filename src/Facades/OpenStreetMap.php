<?php

namespace FourelloDevs\OpenStreetMap\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * Class OpenStreetMap
 * @package FourelloDevs\OpenStreetMap\Facades
 *
 * @author James Carlo Luchavez <carlo.luchavez@fourello.com>
 * @since 2021-05-07
 */
class OpenStreetMap extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor(): string
    {
        return 'openstreetmap';
    }
}

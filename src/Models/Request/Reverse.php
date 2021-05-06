<?php


namespace FourelloDevs\OpenStreetMap\Models\Request;

/**
 * Class Reverse
 * @package FourelloDevs\OpenStreetMap\Models\Request
 *
 * @author James Carlo Luchavez <carlo.luchavez@fourello.com>
 * @since 2021-05-06
 */
class Reverse extends BaseModel
{
    /**
     * Latitude
     *
     * @var double
     */
    public $lat;

    /**
     * Longitude
     *
     * @var double
     */
    public $lon;
}

<?php


namespace FourelloDevs\OpenStreetMap\Models\Response;

/**
 * Class Address
 * @package FourelloDevs\OpenStreetMap\Models\Response
 *
 * @author James Carlo Luchavez <carlo.luchavez@fourello.com>
 * @since 2021-05-06
 */
class Address extends BaseModel
{
    public $road;
    public $neighbourhood;
    public $village;
    public $city;
    public $region;
    public $state_district;
    public $state;
    public $postcode;
    public $country;
    public $country_code;
}

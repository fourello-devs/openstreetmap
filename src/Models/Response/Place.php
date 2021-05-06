<?php


namespace FourelloDevs\OpenStreetMap\Models\Response;

/**
 * Class Place
 * @package FourelloDevs\OpenStreetMap\Models\Response
 *
 * @author James Carlo Luchavez <carlo.luchavez@fourello.com>
 * @since 2021-05-06
 */
class Place extends BaseModel
{
    /**
     * Place ID
     *
     * @var int
     */
    public $place_id;

    /**
     * License
     *
     * @var string
     */
    public $licence;

    /**
     * OSM Type
     *
     * @var string
     */
    public $osm_type;

    /**
     * OSM ID
     *
     * @var int
     */
    public $osm_id;

    /**
     * Bounding Box
     *
     * @var double[]
     */
    public $boundingbox;

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

    /**
     * Display Name
     *
     * @var string
     */
    public $display_name;

    /**
     * Place Rank
     * @var int
     */
    public $place_rank;

    /**
     * Category
     *
     * @var string
     */
    public $category;

    /**
     * Type
     *
     * @var string
     */
    public $type;

    /**
     * Importance
     *
     * @var string
     */
    public $importance;

    /**
     * Icon
     *
     * @var string
     */
    public $icon;

    /**
     * Address
     *
     * @var Address
     */
    public $address;

    /**
     * Extra Tags
     *
     * @var array
     */
    public $extratags;

    /***** SETTERS *****/

    /**
     * Set address of Place object.
     *
     * @param array|Address $address
     */
    public function setAddress($address): void
    {
        $this->address = is_array($address) ? new Address($address) : $address;
    }
}

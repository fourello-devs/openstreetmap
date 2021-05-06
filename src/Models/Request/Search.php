<?php


namespace FourelloDevs\OpenStreetMap\Models\Request;

/**
 * Class Search
 * @package FourelloDevs\OpenStreetMap\Models\Request
 *
 * @author James Carlo Luchavez <carlo.luchavez@fourello.com>
 * @since 2021-05-06
 */
class Search extends BaseModel
{
    /**
     * Free-form query string to search for.
     *
     * @var string
     */
    public $q;

    /**
     * @var string
     */
    public $street;

    /**
     * @var string
     */
    public $city;

    /**
     * @var string
     */
    public $county;

    /**
     * @var string
     */
    public $state;

    /**
     * @var string
     */
    public $country;

    /**
     * @var string
     */
    public $postalcode;

    /**
     * Limit search results to one or more countries (e.g. gb for the United Kingdom, de for Germany).
     *
     * @var string[]
     */
    protected $country_codes = [];

    /**
     * Limit the number of returned results. (Default: 10, Maximum: 50)
     *
     * @var int
     */
    protected $search_limit = 10;

    /**
     * Search constructor.
     */
    public function __construct()
    {
        $this->country_codes = explode(',', strtolower(config('openstreetmap.countrycodes', '')));
        $this->setSearchLimit(config('openstreetmap.limit', 10));
    }

    /***** GETTERS *****/

    /**
     * Get country codes.
     *
     * @return string
     */
    public function getCountryCodes()
    {
        return strtolower(implode(',', $this->country_codes));
    }

    /**
     * Get search limit.
     *
     * @return int
     */
    public function getSearchLimit()
    {
        return $this->search_limit;
    }

    /***** SETTERS *****/

    /**
     * Add country code to consider in searching.
     *
     * @param string $country_code
     */
    public function addCountryCode(string $country_code): void
    {
        $country_code = str_replace(' ', '', strtolower(trim($country_code)));
        if (empty($country_code) === FALSE) {
            $country_code = explode(',', $country_code);
            $this->country_codes = array_merge($this->country_codes, $country_code);
            $this->country_codes = array_values(array_unique($this->country_codes));
        }
    }

    /**
     * Add country code to consider in searching.
     *
     * @param string $country_code
     */
    public function removeCountryCode(string $country_code): void
    {
        $country_code = str_replace(' ', '', strtolower(trim($country_code)));
        if (empty($country_code) === FALSE) {
            $country_code = explode(',', $country_code);
            $this->country_codes = array_values(array_diff($this->country_codes, $country_code));
        }
    }

    /**
     * Set search limit for results.
     *
     * @param int $search_limit
     */
    public function setSearchLimit(int $search_limit): void
    {
        if ($search_limit > 0 && $search_limit <= 50 && $search_limit !== $this->search_limit) {
            $this->search_limit = $search_limit;
        }
    }

    /***** METHODS *****/

    /**
     * Serialize Search object.
     *
     * @return $this
     */
    public function jsonSerialize(): Search
    {
        $this->limit = $this->getSearchLimit();
        $this->countrycodes = $this->getCountryCodes();

        // Remove empty and null fields
        parent::jsonSerialize();

        return $this;
    }
}

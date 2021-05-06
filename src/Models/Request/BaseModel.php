<?php


namespace FourelloDevs\OpenStreetMap\Models\Request;

/**
 * Class BaseModel
 * @package FourelloDevs\OpenStreetMap\Models
 *
 * @author James Carlo Luchavez <carlo.luchavez@fourello.com>
 * @since 2021-05-06
 */
class BaseModel implements \JsonSerializable
{
    /**
     * Output format
     *
     * @var string
     */
    protected $output_format = 'jsonv2';

    /**
     * Include extra tags on output or not.
     *
     * @var bool
     */
    protected $hasExtraTags = FALSE;

    /**
     * Include address details on output or not.
     *
     * @var bool
     */
    protected $hasAddressDetails = FALSE;


    /***** SETTERS *****/

    /**
     * Include extra tags on output.
     *
     * @param bool|null $bool
     */
    public function includeExtraTags(?bool $bool = TRUE): void
    {
        $this->hasExtraTags = $bool;
    }

    /**
     * Include address details on output.
     *
     * @param bool|null $bool
     */
    public function includeAddressDetails(?bool $bool = TRUE): void
    {
        $this->hasAddressDetails = $bool;
    }

    /**
     * Specify data which should be serialized to JSON
     * @link https://php.net/manual/en/jsonserializable.jsonserialize.php
     * @return mixed data which can be serialized by <b>json_encode</b>,
     * which is a value of any type other than a resource.
     * @since 5.4
     */
    public function jsonSerialize()
    {
        $this->format = $this->output_format;

        if($this->hasExtraTags) {
            $this->extratags = 1;
        }

        if ($this->hasAddressDetails) {
            $this->addressdetails = 1;
        }

        foreach (get_object_vars($this) as $key=>$value) {
            if (empty($value)){
                unset($this->$key);
            }
        }
        return $this;
    }
}

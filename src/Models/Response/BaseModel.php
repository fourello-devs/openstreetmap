<?php


namespace FourelloDevs\OpenStreetMap\Models\Response;

use Illuminate\Http\Client\Response;
use Illuminate\Support\Arr;
use Illuminate\Support\Str;

/**
 * Class BaseModel
 * @package FourelloDevs\OpenStreetMap\Models\Response
 */
abstract class BaseModel implements \JsonSerializable
{
    /**
     * BaseModel constructor.
     * @param array|Response|null $array
     * @param string|null $key
     */
    public function __construct($array = NULL, ?string $key = NULL)
    {
        if(empty($array) === FALSE) {
            if($array instanceof Response){
                $this->parse($array, $key);
            }
            elseif (is_array($array)){
                $this->setFields($array);
            }
        }
    }

    /**
     * @param Response $response
     * @param string|null $key
     * @return BaseModel
     */
    public function parse(Response $response, ?string $key = NULL): BaseModel
    {
        if($response->ok()) {
            $array = $response->json($key);
            $this->setFields($array);
        }
        return $this;
    }

    /**
     * @param array $array
     */
    private function setFields(array $array): void
    {
        foreach (get_object_vars($this) as $key=>$value) {
            if(Arr::has($array, $key)){
                if(method_exists($this, $method = Str::camel('set' . $key))) {
                    $this->$method($array[$key]);
                }
                else {
                    $this->{$key} = $array[$key];
                }
            }
        }
    }

    public function jsonSerialize()
    {
        foreach (get_object_vars($this) as $key=>$value) {
            if (empty($value)){
                unset($this->$key);
            }
        }
        return $this;
    }
}

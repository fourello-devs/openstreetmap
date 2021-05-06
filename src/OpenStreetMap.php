<?php

namespace FourelloDevs\OpenStreetMap;

use Illuminate\Http\Client\Response;
use Illuminate\Support\Facades\Http;

/**
 * Class OpenStreetMap
 * @package FourelloDevs\OpenStreetMap
 *
 * @author James Carlo Luchavez <carlo.luchavez@fourello.com>
 * @since 2021-05-06
 */
class OpenStreetMap
{
    /**
     * Nominatim OpenStreetMap URL
     */
    public const BASE_URL = 'https://nominatim.openstreetmap.org';

    /***** GETTERS *****/

    public function getBaseUrl(): string
    {
        return self::BASE_URL;
    }

    /***** METHODS *****/

    /**
     * @param Search $search
     * @return Place[]
     * @throws \JsonException
     */
    public function getSearch(Search $search): array
    {
        $places = [];
        $data = json_decode(json_encode($search, JSON_THROW_ON_ERROR), true, 512, JSON_THROW_ON_ERROR);

        $res = $this->makeRequest('search', $data);

        if ($res->ok()) {
            foreach ($res->json() as $place) {
                $places[] = new Place($place);
            }
        }
        return $places;
    }

    /**
     * @param Reverse $reverse
     * @return Place|null
     * @throws \JsonException
     */
    public function getReverse(Reverse $reverse): ?Place
    {
        $place = NULL;

        $data = json_decode(json_encode($reverse, JSON_THROW_ON_ERROR), true, 512, JSON_THROW_ON_ERROR);

        $res = $this->makeRequest('reverse', $data);

        if ($res->ok()) {
            $place = new Place($res->json());
        }

        return $place;
    }

    /**
     * @return array|mixed
     */
    public function getStatus()
    {
        $data['format'] = 'json';
        return $this->makeRequest('status.php', $data)->json();
    }

    /***** OTHER METHODS *****/

    /**
     * @param string $append_url
     * @param array $data
     * @return Response
     */
    public function makeRequest(string $append_url = '', array $data = []): Response
    {
        // Prepare URL

        $url = $this->getBaseUrl();

        if(empty(trim($append_url)) === FALSE) {
            $url .= '/' . $append_url;
        }

        // Attach Email Address As Per OSM Policy

        $email = config('openstreetmap.email');
        if (empty($email) === FALSE) {
            $data['email'] = $email;
        }

        return Http::get($url, $data);
    }
}

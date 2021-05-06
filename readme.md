# Openstreetmap

[![Latest Version on Packagist][ico-version]][link-packagist]
[![Total Downloads][ico-downloads]][link-downloads]
[![Build Status][ico-travis]][link-travis]
[![StyleCI][ico-styleci]][link-styleci]

This is where your description should go. Take a look at [contributing.md](contributing.md) to see a to do list.

## Installation

Via Composer

``` bash
$ composer require fourello-devs/openstreetmap
```

## Usage

This package offers two convenient way to directly use OpenStreetMap.

- <b>OpenStreetMap</b> facade
- <b>osm()</b> helper function

There are three (3) methods available for you to use:
- <b>getSearch()</b>
- <b>getReverse()</b>
- <b>getStatus()</b>

This package is some form of Laravel-flavored SDK for OpenStreetMap.
To learn more about OpenStreetMap, please refer to this [documentation](https://nominatim.org/release-docs/latest/).

Note: There should be five (5) methods supposedly but due to time constraint and project requirements, the remaining two which are [<b>Address Lookup</b>](https://nominatim.org/release-docs/latest/api/Lookup/) and [<b>Details</b>](https://nominatim.org/release-docs/latest/api/Details/) are not included. You can fork this project for free. If given a chance, I will include the remaining two in the future.

### Setup Environment Variables

```dotenv
# (optional) Comma-separated Country Codes
OSM_COUNTRY_CODES=PH,JP
# (optional) Number of places to display (min: 10, max: 50)
OSM_SEARCH_LIMIT=5
# (optional) 
OSM_EMAIL_ADDRESS=carlo.luchavez@fourello.com
```

For complete list of country codes, visit [Wikipedia](https://en.wikipedia.org/wiki/ISO_3166-1_alpha-2). 

If you are making large numbers of request please include an appropriate <b><i>email address</i></b> to identify your requests. See Nominatim's [Usage Policy](https://operations.osmfoundation.org/policies/nominatim/) for more details.

### Demonstration

```php
use FourelloDevs\OpenStreetMap\Models\Request\Reverse;
use FourelloDevs\OpenStreetMap\Models\Request\Search;

Route::get('status', function () {

    return osm()->getStatus();
    
});

Route::get('search', function () {

    $search = new Search();
    $search->q = 'Manila';
    $search->includeAddressDetails();
    $search->includeExtraTags();

    return osm()->getSearch($search);
    
});

Route::get('reverse', function () {

    $reverse = new Reverse();
    $reverse->lat = -34.4391708;
    $reverse->lon = -58.7064573;
    $reverse->includeAddressDetails();
    $reverse->includeExtraTags();

    return osm()->getReverse($reverse);
    
});

```

## Change log

Please see the [changelog](changelog.md) for more information on what has changed recently.

## Testing

``` bash
$ composer test
```

## Contributing

Please see [contributing.md](contributing.md) for details and a todolist.

## Security

If you discover any security related issues, please email carlo.luchavez@fourello.com instead of using the issue tracker.

## Credits

- [James Carlo Luchavez][link-author]
- [All Contributors][link-contributors]

## License

MIT. Please see the [license file](license.md) for more information.

[ico-version]: https://img.shields.io/packagist/v/fourello-devs/openstreetmap.svg?style=flat-square
[ico-downloads]: https://img.shields.io/packagist/dt/fourello-devs/openstreetmap.svg?style=flat-square
[ico-travis]: https://img.shields.io/travis/fourello-devs/openstreetmap/master.svg?style=flat-square
[ico-styleci]: https://styleci.io/repos/12345678/shield

[link-packagist]: https://packagist.org/packages/fourello-devs/openstreetmap
[link-downloads]: https://packagist.org/packages/fourello-devs/openstreetmap
[link-travis]: https://travis-ci.org/fourello-devs/openstreetmap
[link-styleci]: https://styleci.io/repos/12345678
[link-author]: https://github.com/fourello-devs
[link-contributors]: ../../contributors

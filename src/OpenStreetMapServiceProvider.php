<?php

namespace FourelloDevs\OpenStreetMap;

use Illuminate\Support\Facades\File;
use Illuminate\Support\ServiceProvider;

/**
 * Class OpenStreetMapServiceProvider
 * @package FourelloDevs\OpenStreetMap
 *
 * @author James Carlo Luchavez <carlo.luchavez@fourello.com>
 * @since 2021-05-07
 */
class OpenStreetMapServiceProvider extends ServiceProvider
{
    /**
     * Perform post-registration booting of services.
     *
     * @return void
     */
    public function boot(): void
    {
        // $this->loadTranslationsFrom(__DIR__.'/../resources/lang', 'fourello-devs');
        // $this->loadViewsFrom(__DIR__.'/../resources/views', 'fourello-devs');
        // $this->loadMigrationsFrom(__DIR__.'/../database/migrations');
        // $this->loadRoutesFrom(__DIR__.'/routes.php');

        // Publishing is only necessary when using the CLI.
        if ($this->app->runningInConsole()) {
            $this->bootForConsole();
        }

        // Register Helpers
        $this->registerHelpers();
    }

    /**
     * Register any package services.
     *
     * @return void
     */
    public function register(): void
    {
        $this->mergeConfigFrom(__DIR__.'/../config/openstreetmap.php', 'openstreetmap');

        // Register the service the package provides.
        $this->app->singleton('openstreetmap', function ($app) {
            return new OpenStreetMap;
        });
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return ['openstreetmap'];
    }

    /**
     * Console-specific booting.
     *
     * @return void
     */
    protected function bootForConsole(): void
    {
        // Publishing the configuration file.
        $this->publishes([
            __DIR__.'/../config/openstreetmap.php' => config_path('openstreetmap.php'),
        ], 'openstreetmap.config');

        // Publishing the views.
        /*$this->publishes([
            __DIR__.'/../resources/views' => base_path('resources/views/vendor/fourello-devs'),
        ], 'openstreetmap.views');*/

        // Publishing assets.
        /*$this->publishes([
            __DIR__.'/../resources/assets' => public_path('vendor/fourello-devs'),
        ], 'openstreetmap.views');*/

        // Publishing the translation files.
        /*$this->publishes([
            __DIR__.'/../resources/lang' => resource_path('lang/vendor/fourello-devs'),
        ], 'openstreetmap.views');*/

        // Registering package commands.
        // $this->commands([]);
    }

    /**
     * Register helpers file
     */
    public function registerHelpers(): void
    {
        $path = __DIR__ . '/../helpers/CustomHelpers.php';
        if (! function_exists('osm') && File::exists($path)) {
            require_once __DIR__ . '/../helpers/CustomHelpers.php';
        }
    }
}

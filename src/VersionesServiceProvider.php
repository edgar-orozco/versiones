<?php

namespace EdgarOrozco\Versiones;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Route;

class VersionesServiceProvider extends ServiceProvider
{
    /**
     * Perform post-registration booting of services.
     *
     * @return void
     */
    public function boot()
    {
        // $this->loadTranslationsFrom(__DIR__.'/../resources/lang', 'edgar-orozco');
        $this->loadViewsFrom(__DIR__ . '/resources/views', 'EdgarOrozco');
        // $this->loadMigrationsFrom(__DIR__.'/../database/migrations');


        if (! $this->app->routesAreCached()) {
            $this->registerRoutes();
        }

        // Publishing is only necessary when using the CLI.
        if ($this->app->runningInConsole()) {
            //$this->bootForConsole();
        }
    }

    /**
     * Register any package services.
     *
     * @return void
     */
    public function register()
    {
        $this->mergeConfigFrom(__DIR__ . '/../config/versiones.php', 'versiones');

        // Register the service the package provides.
        $this->app->singleton('versiones', function ($app) {
            return new Versiones;
        });
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return ['versiones'];
    }

    /**
     * Console-specific booting.
     *
     * @return void
     */
    protected function bootForConsole()
    {
        // Publishing the configuration file.
        $this->publishes([
                             __DIR__ . '/../config/versiones.php' => config_path('versiones.php'),
        ], 'versiones.config');

        // Publishing the views.
        /*$this->publishes([
            __DIR__.'/../resources/views' => base_path('resources/views/vendor/edgar-orozco'),
        ], 'versiones.views');*/

        // Publishing assets.
        /*$this->publishes([
            __DIR__.'/../resources/assets' => public_path('vendor/edgar-orozco'),
        ], 'versiones.views');*/

        // Publishing the translation files.
        /*$this->publishes([
            __DIR__.'/../resources/lang' => resource_path('lang/vendor/edgar-orozco'),
        ], 'versiones.views');*/

        // Registering package commands.
        // $this->commands([]);
    }

    protected function registerRoutes()
    {
        Route::group($this->routeConfiguration(), function () {
            $this->loadRoutesFrom(__DIR__.'/routes/web.php');
        });
    }

    protected function routeConfiguration()
    {
        return [
            'middleware' => 'web'
        ];
    }
}

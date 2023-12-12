<?php

namespace Ignitedcms\Ignitedcms;

use Illuminate\Support\ServiceProvider;

class IgnitedcmsServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     */
    public function boot()
    {
        /*
         * Optional methods to load your package assets
         */
        // $this->loadTranslationsFrom(__DIR__.'/../resources/lang', 'ignitedcms');
        $this->loadViewsFrom(__DIR__.'/views', 'ignitedcms');

        $this->loadMigrationsFrom(__DIR__.'/migrations');

        $this->loadRoutesFrom(__DIR__.'/routes/web.php');

        if ($this->app->runningInConsole()) {
            $this->publishes([
                __DIR__.'/../config/app.php' => config_path('app.php'),
            ], 'config');

            // Publishing ONLY the custom.
            $this->publishes([
                __DIR__.'/custom' => resource_path('views/custom'),
            ], 'views');

            // Publishing assets.
            $this->publishes([
                __DIR__.'/public' => public_path(''),
            ], 'assets');

            // Publishing Helper.
            $this->publishes([
                __DIR__.'/Helper/Helper.php' => app_path('Helper/Helper.php'),
            ], 'helper');

            // Publishing the translation files.
            /*$this->publishes([
                __DIR__.'/../resources/lang' => resource_path('lang/vendor/ignitedcms'),
            ], 'lang');*/

            // Registering package commands.
            // $this->commands([]);
        }
    }

    /**
     * Register the application services.
     */
    public function register()
    {
        // Automatically apply the package configuration
        // $this->mergeConfigFrom(__DIR__.'/../config/config.php', 'ignitedcms');

        // Register the main class to use with the facade
        $this->app->singleton('ignitedcms', function () {
            return new Ignitedcms;
        });
    }
}

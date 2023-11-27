<?php

namespace Ignitedcms\Ignitedcms\Tests;

use Ignitedcms\Ignitedcms\IgnitedcmsServiceProvider;
use Orchestra\Testbench\TestCase as Orchestra;

class TestCase extends Orchestra
{
    protected function getPackageProviders($app)
    {
        return [
            IgnitedcmsServiceProvider::class,
        ];
    }

   protected function getEnvironmentSetUp($app)
   {
       // Define testing environment configurations here
       $app['config']->set('database.default', 'mysql');
       $app['config']->set('database.connections.mysql', [
           'driver' => 'mysql',
           'host' => '127.0.0.1',
           'port' => '8889',
           'database' => 'laravel',
           'username' => 'root',
           'password' => 'root',
           // Other MySQL configurations...
       ]);
   }

}

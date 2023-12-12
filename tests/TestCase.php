<?php

namespace Ignitedcms\Ignitedcms\Tests;

use Ignitedcms\Ignitedcms\IgnitedcmsServiceProvider;
use Orchestra\Testbench\TestCase as Orchestra;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Support\Facades\DB;

class TestCase extends Orchestra
{
   use DatabaseMigrations;

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

    protected function setUp(): void
    {
        parent::setUp();

        //Insert admin user
       $insertid = DB::table('user')->insertGetId([
          'email' => 'foo@mail.com',
          'password'=>'Letmein1',
          'permissiongroup'=>1
       ]);

        //Insert permissions and permission group

    }
}

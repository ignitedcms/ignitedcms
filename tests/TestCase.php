<?php

namespace Ignitedcms\Ignitedcms\Tests;

use Ignitedcms\Ignitedcms\IgnitedcmsServiceProvider;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Orchestra\Testbench\TestCase as Orchestra;

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
            'password' => Hash::make('Letmein1'),
            'permissiongroup' => 1,
        ]);

        //Insert permissions and permission group
        $prefix = '';

        $sql1 = 'INSERT INTO `'.$prefix."permissions` (`permissionID`, `permission`,`order_position`) VALUES
		(3, 'email',6),
		(5, 'permissions',8),
		(6, 'profile',1),
		(9,'users',9),
		(7,'menu',2),
		(10,'database',10),
		(13,'field_builder',13),
		(14,'sections',14),
		(15,'entries',15),
		(17,'asset_lib',17),
		(18,'site_settings',18),
		(19,'paypal',19),
		(20,'plugins',20),
      (21,'ipn',21);";

        $sql2 = 'INSERT INTO `'.$prefix.'permission_map`(`groupID`, `permissionID`) VALUES
		(1,3),
		(1,5),
		(1,6),
		(1,7),
		(1,9),
		(1,10),
		(1,13),
		(1,14),
		(1,15),
		(1,17),
		(1,18),
		(1,19),
		(1,20),
      (1,21);';

        $sql3 = 'INSERT INTO `'.$prefix."permission_groups`(`groupID`, `groupName`) VALUES
		(1,'Administrators');";

        DB::statement($sql1);
        DB::statement($sql2);
        DB::statement($sql3);

    }
}

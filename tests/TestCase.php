<?php

namespace Ignitedcms\Ignitedcms\Tests;

use Orchestra\Testbench\TestCase as Orchestra;
use Ignitedcms\Ignitedcms\IgnitedcmsServiceProvider;

class TestCase extends Orchestra
{
    protected function getPackageProviders($app)
    {
        return [
            IgnitedcmsServiceProvider::class,
        ];
    }
}

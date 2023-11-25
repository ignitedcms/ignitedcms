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
}

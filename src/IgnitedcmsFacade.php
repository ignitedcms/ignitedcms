<?php

namespace Ignitedcms\Ignitedcms;

use Illuminate\Support\Facades\Facade;

/**
 * @see \Ignitedcms\Ignitedcms\Skeleton\SkeletonClass
 */
class IgnitedcmsFacade extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'ignitedcms';
    }
}

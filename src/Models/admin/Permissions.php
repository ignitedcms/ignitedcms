<?php

namespace Ignitedcms\Ignitedcms\Models\admin;

use Illuminate\Support\Facades\DB;

class Permissions
{
    public static function all()
    {
        return DB::table('permission_groups')
            ->select('*')
            ->get();

    }

    public static function foo()
    {
        echo 'foo';
    }
}

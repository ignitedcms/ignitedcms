<?php
/*
|---------------------------------------------------------------
| Profile model
|---------------------------------------------------------------
|
| @author: IgnitedCMS
| @license: MIT
| @version: 1.0
| @since: 1.0
|
*/

namespace Ignitedcms\Ignitedcms\Models\admin;

use Illuminate\Support\Facades\DB;

class Profile
{
    public static function first($userid)
    {

        $rows = DB::table('user')
            ->select('*')
            ->where('id', '=', $userid)
            ->limit(1)
            ->get();

        return $rows[0];
    }

    public static function update($userid, $fullname)
    {
        DB::table('user')
            ->where('id', '=', $userid)
            ->update([
                'fullname' => $fullname,
            ]);

    }
}

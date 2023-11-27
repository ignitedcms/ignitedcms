<?php
/*
|---------------------------------------------------------------
| Asset model
|---------------------------------------------------------------
|
|
| @author: IgnitedCMS
| @license: MIT
| @version: 1.0
| @since: 1.0
*/

namespace Ignitedcms\Ignitedcms\Models\admin;

use Illuminate\Support\Facades\DB;

class Asset
{
    public static function all()
    {
        return DB::table('assetfields')->get();
    }

    //Go ahead and insert the upload info
    //into our database
    public static function create(
       $filename,
       $kind,
       $url,
       $thumb,
       $fieldname
    )
    {
       $insertid = DB::table('assetfields')->insertGetId([
          'filename' => $filename,
          'kind' => $kind,
          'url' => $url,
          'thumb' => $thumb,
          'fieldname' => $fieldname
       ]);

    }
}

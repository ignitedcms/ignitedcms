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

    public static function get_all_permissions()
    {
       return DB::table('permissions')
           ->select('*')
        ->orderBy('order_position','asc')
            ->get();
       
    }

    /*
     * Creates a new permission group
     *
     *
     * @param   string $groupName
     * @param   array  $arr [2,3] (permissions to go into permission map)
     * @return  void
     */
    public static function create_group($groupName, $arr)
    {
       //First create the permission_group
       $insertid = DB::table('permission_groups')->insertGetId([
          'groupName' => $groupName
       ]);

       //Now loop through arr and use $insertid
       //$array = (explode(",",$arr));
       foreach($arr as $row)
       {
          DB::table('permission_map')->insertGetId([
             'groupID' => $insertid,
             'permissionID' => $row
          ]);
       }
       die();

    }
}
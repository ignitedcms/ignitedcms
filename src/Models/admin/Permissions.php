<?php
/*
|---------------------------------------------------------------
| Permissions model
|---------------------------------------------------------------
|
| @author: IgnitedCMS
| @license: MIT
| @version: 1.0
| @since: 1.0
*/

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
            ->orderBy('order_position', 'asc')
            ->get();

    }

    //Let's check permissions and add to middleware
    public static function permission_middleware($arg)
    {
        //get userid from session and return all
        //controllers they have access to
        $userid = session('userid');
        $row = DB::table('user')
            ->select('permissiongroup')
            ->where('id', '=', $userid)
            ->limit(1)
            ->get();

        $permissiongroup = $row[0]->permissiongroup;

        //now get all from permission map
        $rows = DB::table('permission_map')
            ->select('permissionID')
            ->where('groupID', '=', $permissiongroup)
            ->orderBy('permissionID', 'asc')
            ->get();

        $pass = false;
        foreach ($rows as $row) {
            if ($arg == $row->permissionID) {
                $pass = true;
                break;
            }
        }

        return $pass;
    }

    //Checks if any users are using this permissionID
    //This is bad so we can't delete this permissionID
    public static function check_if_permissionid_is_used($permissionID)
    {
        $rows = DB::table('user')
            ->select('*')
            ->get();

        $stop = false;
        foreach ($rows as $row) {
            if ($row->permissiongroup == $permissionID) {
                $stop = true;
                break;
            }
        }

        return $stop;

    }

    public static function update_permissions($groupID, $map)
    {
        if ($map == null) {

            DB::table('permission_map')
                ->where('groupID', '=', $groupID)
                ->delete();
        } else {
            DB::table('permission_map')
                ->where('groupID', '=', $groupID)
                ->delete();

            //Now add the POST array
            foreach ($map as $row) {
                DB::table('permission_map')->insertGetId([
                    'groupID' => $groupID,
                    'permissionID' => $row,
                ]);
            }
        }

    }

    public static function get_group_name($id)
    {
        $rows = DB::table('permission_groups')
            ->select('groupName')
            ->where('groupID', '=', $id)
            ->limit(10)
            ->get();

        return $rows[0]->groupName;
    }

    // Returns all the permissions by group
    public static function get_permissions_by_groupid($group_id)
    {
        return DB::table('permission_map')
            ->select('permissionID')
            ->where('groupID', '=', $group_id)
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
            'groupName' => $groupName,
        ]);

        //Now loop through arr and use $insertid
        //$array = (explode(",",$arr));
        foreach ($arr as $row) {
            DB::table('permission_map')->insertGetId([
                'groupID' => $insertid,
                'permissionID' => $row,
            ]);
        }
    }

    //Warning special criteria
    //Do not delete admin
    //Do not delete if assigned to a user
    public static function destroy($id)
    {

        //First erase permission_map
        DB::table('permission_map')
            ->where('groupID', '=', $id)
            ->delete();

        DB::table('permission_groups')
            ->where('groupID', '=', $id)
            ->delete();

    }
}

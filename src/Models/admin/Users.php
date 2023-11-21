<?php
/*
|---------------------------------------------------------------
| Users model
|---------------------------------------------------------------
|
| @author: IgnitedCMS
| @license: MIT
| @version: 1.0
| @since: 1.0
|
*/

namespace App\Models\admin;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class Users
{
    /*
     * Get all users from db and join with permissiongroup
     *
     *
     * @return  array (all users)
     */
    public static function all()
    {
        return DB::table('user')
            ->join('permission_groups', 'user.permissiongroup', '=', 'permission_groups.groupID')
            ->select('*')
            ->get();
    }

    public static function permission_groups()
    {
        return DB::table('permission_groups')
            ->select('*')
            ->get();
    }

    /*
     * Creates a new user in the db
     * checks to see if email is available
     * adds password and assign permission group
     *
     *
     * @param   string $email
     * @param   string $password
     * @param   int $permission_group
     * @return  void (success or fail
     */
    public static function create_user($email, $password, $permissiongroup)
    {
        DB::table('user')->insert([
            'email' => $email,
            'password' => Hash::make($password),
            'permissiongroup' => $permissiongroup,
        ]);
    }

    /*
     * Get the user's email address
     *
     *
     * @param   string $userid
     * @return  string $email
     */
    public static function get_email($id)
    {
        $rows = DB::table('user')
            ->select('email')
            ->where('id', '=', $id)
            ->limit(1)
            ->get();

        return $rows[0]->email;
    }

    /*
     * Updates the users permissiongroup
     *
     *
     * @param   int $userid
     * @param   int $groupid
     * @return  void (updates permissions)
     */
    public static function update_permissions($id, $groupid)
    {
        DB::table('user')
            ->where('id', '=', $id)
            ->update([
                'permissiongroup' => $groupid,
            ]);
    }

    public static function destroy($id)
    {
        // first check if admin
        if ($id == '1') {
            echo 'you cannot delete admin';
        } else {
            DB::table('user')
                ->where('id', '=', $id)
                ->delete();
        }
    }
}

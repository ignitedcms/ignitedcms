<?php
/*
|---------------------------------------------------------------
| Login model
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
use Illuminate\Support\Str;

class Login
{
    public static function sendPasswordReset($email)
    {
        //first check if email exists
        $query = DB::table('user')
            ->where('email', '=', $email)
            ->get();

        if ($query->count() > 0) {
            $token = Str::random(30);
            //now update db
            DB::table('user')
                ->where('email', '=', $email)
                ->update([
                    'activ_key' => $token,
                ]);

            self::sendEmail($token);

            return true;
        } else {
            return false;
        }
    }

    //Send an email with reset token link
    public static function sendEmail($token)
    {
        //Send email
        //Assumes email config in .env file
    }

    /*
     * Authorize token, if ok
     * allow password reset
     *
     *
     * @param   string $token
     * @return  $userid or false
     */
    public static function authorizeToken($token)
    {
        $query = DB::table('user')
            ->select('*')
            ->where('activ_key', '=', $token)
            ->get();

        if ($query->count() > 0) {
            //set session id for user
            $userid = ($query[0]->id);

            return $userid;

        } else {
            return false;
        }

    }
}
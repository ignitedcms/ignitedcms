<?php
/*
|---------------------------------------------------------------
| Settings model
|---------------------------------------------------------------
| For managing asset uploads types globally
|
| @author: IgnitedCMS
| @license: MIT
| @version: 1.0
| @since: 1.0
*/

namespace Ignitedcms\Ignitedcms\Models\admin;

use Illuminate\Support\Facades\DB;

class Settings
{
    /*
     * Get all site_settings data
     *
     *
     * @return  db query->result
     */
    public static function all()
    {
        return DB::table('site_settings')->get();
    }

    /*
     * Update allowed mime type by name
     * and change enabled to true (1)
     *
     *
     * @param   string $name
     * @return  void
     */
    public static function update($name)
    {
        DB::table('site_settings')
            ->where('name', '=', $name)
            ->update([
                'enabled' => 1,
            ]);
    }
}

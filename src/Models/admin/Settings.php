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

    public static function getSections()
    {
       return DB::table('section')
          ->select('*')
          ->where('sectiontype','!=', 'global')
          ->get();
       
    }

    public static function getFileExtensions()
    {
        $string = '';
        $query = DB::table('site_settings')
            ->select('*')
            ->where('enabled', '=', 1)
            ->get();

        foreach ($query as $row) {
            $string = $string.$row->extensions.',';
        }

        //remove trailing ,
        return trim($string, ',');

    }

    /*
     * Update allowed mime type by name
     * and change enabled to true (1)
     *
     *
     * @param   array of $names
     * @return  void
     */
    public static function updateSettings($names)
    {
        //first we need to nuke all the enabled
        $query = DB::table('site_settings')
            ->select('*')
            ->get();

        foreach ($query as $row) {
            DB::table('site_settings')
                ->where('name', '=', $row->name)
                ->update([
                    'enabled' => 0,
                ]);

        }

        foreach ($names as $row) {

            DB::table('site_settings')
                ->where('name', '=', $row)
                ->update([
                    'enabled' => 1,
                ]);
        }
    }
}

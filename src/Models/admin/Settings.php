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
            ->where('sectiontype', '!=', 'global')
            ->get();
    }

    public static function setUrl($site_url)
    {
        //first let's delete any routes with '/'
        DB::table('routes')
            ->where('route', '=', '/')
            ->delete();

        $query = DB::table('routes')
            ->select('controller')
            ->where('route', '=', $site_url)
            ->limit(1)
            ->get();

        $controller = $query[0]->controller;

        //now insert into routes
        $insertid = DB::table('routes')->insertGetId([
            'route' => '/',
            'controller' => $controller,
        ]);

        //Finally add to url_settings table
        DB::table('url_settings')
            ->where('id', '=', '1')
            ->update([
                'name' => $site_url,
            ]);

    }

    //return the base url if set
    public static function getUrl()
    {
        $query = DB::table('url_settings')
            ->select('name')
            ->where('id', '=', 1)
            ->limit(1)
            ->get();

        return $query[0]->name;
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

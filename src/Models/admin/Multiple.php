<?php
/*
|---------------------------------------------------------------
| Multiple model
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

class Multiple
{
    //Get all entries for section id
    public static function all($sectionid)
    {
        return DB::table('entry')
            ->where('sectionid', '=', $sectionid)
            ->orderBy('sort_order')  //make sure we order
            ->get();
    }

    public static function create($sectionid)
    {
        DB::table('entry')
            ->insert([
                'sectionid' => $sectionid,
                'type' => 'multiple',
                'datecreated' => date('Y-m-d'),

            ]);

        $insert_id = DB::getPdo()->lastInsertId();

        DB::table('content')
            ->insert([
                'entryid' => $insert_id,

            ]);

        /*
        |---------------------------------------------------------------
        | Don't forget to add addional routes
        |---------------------------------------------------------------
        */
    }

    public static function get_section_name($sectionid)
    {
        $data = DB::table('section')
            ->where('id', '=', $sectionid)
            ->select('name')
            ->limit(1)
            ->get();

        return $data[0]->name;
    }

    /*
     * Update the entry sort order for multiples
     *
     *
     * @param   int $id
     * @param   int $sort
     * @return  void
     */
    public static function order($id, $sort)
    {
        $affected = DB::table('entry')
            ->where('id', $id)
            ->update(['sort_order' => $sort]);
    }

    public static function delete($sectionid, $id)
    {

        //get entry title first before removing
        $row = DB::table('content')
            ->select('entrytitle')
            ->where('entryid', '=', $id)
            ->get();

        $entrytitle = $row[0]->entrytitle;

        DB::table('entry')
            ->where('sectionid', '=', $sectionid)
            ->where('id', '=', $id)
            ->delete();
        /*
        |---------------------------------------------------------------
        | IMPORTANT Don't forget to remove routes
        |---------------------------------------------------------------
        |
        */

        $sectionname = self::get_section_name($sectionid);

        DB::table('routes')
            ->where('route', '=', "$sectionname/$entrytitle")
            ->delete();

    }
}

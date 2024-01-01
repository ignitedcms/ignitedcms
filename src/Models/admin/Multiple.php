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
            ->join('content', 'entry.id', '=', 'content.entryid')
            ->where('sectionid', '=', $sectionid)
            ->orderBy('sort_order')  //make sure we order
            ->get();
    }

    public static function search($sectionid, $searchQuery)
    {
        return DB::table('entry')
            ->join('content', 'entry.id', '=', 'content.entryid')
            ->where('sectionid', '=', $sectionid)
            ->where('content.entrytitle', 'like', "%$searchQuery%")
            ->orderBy('sort_order')  //make sure we order
            ->get();

    }

    //creates a single multiple
    public static function create($sectionid, $entrytitle)
    {
        $insertid = DB::table('entry')->insertGetId([
            'sectionid' => $sectionid,
            'type' => 'multiple',
            'datecreated' => date('Y-m-d'),
        ]);

        DB::table('content')
            ->insert([
                'entryid' => $insertid,
                'entrytitle' => $entrytitle,

            ]);

        /*
        |---------------------------------------------------------------
        | Don't forget to add addional routes
        |---------------------------------------------------------------
        */

        $sectionname = self::getSectionName($sectionid);
        $route = "$sectionname/$entrytitle";

        $controller = "admin/parser/display/$sectionid/$insertid";

        $insertid = DB::table('routes')->insertGetId([
            'route' => $route,
            'controller' => $controller,
        ]);

    }

    public static function isDuplicateRoute($route)
    {

        $rows = DB::table('routes')
            ->select('route')
            ->where('route', '=', $route)
            ->get();

        if ($rows->count() > 0) {
            return true;
        } else {
            return false;
        }
    }

    public static function getSectionName($sectionid)
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

        $sectionname = self::getSectionName($sectionid);

        DB::table('routes')
            ->where('route', '=', "$sectionname/$entrytitle")
            ->delete();

    }
}

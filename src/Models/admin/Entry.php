<?php
/*
|---------------------------------------------------------------
| Entry model
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

class Entry
{
    /*
    |---------------------------------------------------------------
    | IMPORTANT
    |---------------------------------------------------------------
    |
    | We need to create an alias as there are two id columns
    |
    */
    public static function single()
    {
        return DB::table('section')
            ->join('entry', 'section.id', '=', 'entry.sectionid')
            ->where('sectiontype', '=', 'single')
            ->select('entry.id as eid', 'section.id as sid', 'section.name')
            ->get();
    }

    public static function multiple()
    {
        return DB::table('section')
            ->where('sectiontype', '=', 'multiple')
            ->select('id as sid', 'name')
            ->get();
    }

    public static function globals()
    {
        return DB::table('section')
            ->join('entry', 'section.id', '=', 'entry.sectionid')
            ->where('sectiontype', '=', 'global')
            ->select('entry.id as eid', 'section.id as sid', 'section.name')
            ->get();
    }

    public static function section_all_fields($sectionid)
    {
        return DB::table('section_layout')
            ->join('fields', 'section_layout.fieldid', '=', 'fields.id')
            ->where('sectionid', '=', $sectionid)
            ->get();
    }

    //save or rather update as entry already exists
    public static function save_to_content($entryid, $fieldname, $data)
    {
        $affected = DB::table('content')
            ->where('entryid', $entryid)
            ->update([$fieldname => $data]);
    }

    //special one off case for multiples
    public static function save_to_content_as_multiple($entryid, $entrytitle)
    {
        /*
        |---------------------------------------------------------------
        | First we need to check if route already exists
        |---------------------------------------------------------------
        |
        | If it does, then delete and add again otherwise insert new
        |
        */

        $route = self::get_route($entryid);

        //Now we have the route let's check if it exists in the database

        if (self::check_route_in_db($route)) {
            DB::table('routes')
                ->where('route', '=', $route)
                ->delete();
        }

        $affected = DB::table('content')
            ->where('entryid', $entryid)
            ->update(['entrytitle' => $entrytitle]);

        //finally create the route
        self::create_routes($entryid);
    }

    //A funky way to handle single rich text fields in the entries
     public function get_single_richtextfields($sectionid, $entryid)
    {
       $query = DB::table('section_layout')
          ->select('*')
          ->where('sectionid','=', $sectionid)
          ->get();
        /*
        |---------------------------------------------------------------
        | Initialise the field stack
        |---------------------------------------------------------------
         */
        $fields = array();

        foreach ($query as $row) {
            /*
            |---------------------------------------------------------------
            | First check field type is rich-text
            | then if true push onto the fields stack
            |---------------------------------------------------------------
             */
            if (self::field_type($row->fieldid) == "rich-text") {
                $fieldname = self::field_name($row->fieldid);
                $arr_chunk = array('name' => $fieldname,
                    'content' => self::get_content($entryid, $fieldname));
                array_push($fields, $arr_chunk);
            }
        }
        //remove first and last characters [,]
        //$matrix = substr($content, 1, -1);
        return json_encode($fields);
    }


    public static function field_type($fieldid)
    {

       $rows = DB::table('fields')
                ->select('type')
                ->where('id','=', $fieldid)
                ->get();

       return $rows[0]->type;
    }

    public static function field_name($fieldid)
    {
       $rows = DB::table('fields')
                ->select('name')
                ->where('id','=', $fieldid)
                ->get();

       return $rows[0]->name;

    }

   /**
     * Get the entry content
     *
     * @param  string  $entryid
     * @param  string  $fieldname
     * @return string
     */
    public static function get_content($entryid, $fieldname)
    {
        $rows = DB::table('content')
            ->select($fieldname)
            ->where('entryid', '=', $entryid)
            ->get();

        if ($rows->count() > 0) {
            return $rows[0]->$fieldname;
        } else {
            return false;
        }
    }


    /*
     * Checks if route is already in db
     *
     *
     * @param   string $route
     * @return  bool  true or false
     */
    public static function check_route_in_db($route)
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

    /*
     * get route
     * Returns the route 'blogs/title'
     *
     *
     * @param   int $entryid
     * @return  string $route
     */
    public static function get_route($entryid)
    {
        $rows = DB::table('content')
            ->select('entrytitle')
            ->where('entryid', '=', $entryid)
            ->limit(1)
            ->get();

        $title = $rows[0]->entrytitle;

        $foo = DB::table('entry')
            ->join('section', 'entry.sectionid', '=', 'section.id')
            ->where('entry.id', '=', $entryid)
            ->select('entry.id as eid', 'section.id as sid', 'section.name')
            ->limit(1)
            ->get();

        $sectionname = $foo[0]->name;

        $route = $sectionname."/$title";

        return $route;
    }

    //for multiples
    public static function create_routes($entryid)
    {
        $foo = DB::table('entry')
            ->join('section', 'entry.sectionid', '=', 'section.id')
            ->where('entry.id', '=', $entryid)
            ->select('entry.id as eid', 'section.id as sid', 'section.name')
            ->limit(1)
            ->get();

        $bar = DB::table('content')
            ->select('entrytitle')
            ->where('entryid', '=', $entryid)
            ->limit(1)
            ->get();

        $sid = $foo[0]->sid;
        $eid = $foo[0]->eid;
        $sectionname = $foo[0]->name;
        $entrytitle = $bar[0]->entrytitle;

        //dd($sid, $eid, $name, $entrytitle);

        //build routes and insert into routing table!!

        DB::table('routes')->insert([
            'route' => "$sectionname/$entrytitle",
            'controller' => "admin/parser/display/$sid/$eid",
        ]);
    }

    public static function is_multiple($entryid)
    {
        $rows = DB::table('entry')
            ->where('id', '=', $entryid)
            ->limit(1)
            ->get();

        if ($rows[0]->type == 'multiple') {
            return true;
        } else {
            return false;
        }
    }

    /*
     * Format checkbox array postdata to a csvstring
     *
     *
     * @param   array $postdata eg ["a", "b"]
     * @return  string  formatted csv string eg "a,b"
     */
    public static function checkbox_format($postdata)
    {
        $tmp = '';
        foreach ($postdata as $row) {
            $tmp = $tmp.$row.',';
        }

        //get rid of trailing comma
        return trim($tmp, ',');
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
}

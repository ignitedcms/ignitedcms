<?php
/*
|---------------------------------------------------------------
| Section model
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

class Section
{
    public static function all()
    {
        return DB::table('section')->get();
    }

    public static function read($id)
    {
        $line = DB::table('section')
            ->where('id', '=', $id)
            ->limit(1)
            ->get();

        return $line[0];
    }

    public static function create($name, $sectiontype, $fields)
    {
        DB::table('section')->insert([
            'name' => $name,
            'sectiontype' => $sectiontype,
        ]);

        //Grab the insertid to use for section
        //layout
        $insert_id = DB::getPdo()->lastInsertId();

        /*
        |---------------------------------------------------------------
        | Fields come in as a csv format
        |---------------------------------------------------------------
        |
        | Loop through and add to section_layout table
        | adding the sort order as we go
        |
        */
        $tmp_arr = explode(',', $fields);

        $counter = 0;
        foreach ($tmp_arr as $part) {
            DB::table('section_layout')->insert([
                'sectionid' => $insert_id,
                'fieldid' => $part,
                'sortorder' => $counter,
            ]);
            $counter++;
        }

        //Now insert into entry
        //Beware of multiples

        DB::table('entry')->insert([
            'sectionid' => $insert_id,
            'type' => $sectiontype,
            'datecreated' => date('Y-m-d'),

        ]);

        $entry_id = DB::getPdo()->lastInsertId();
        //add a line to the content table
        //Beware of multiples
        DB::table('content')->insert([
            'entryid' => $entry_id,

        ]);

        //finally add route

        //if type = global do not add route!

        if ($sectiontype == 'global') {
            // do nothing
        } elseif ($sectiontype == 'multiple') {
            //Special landing page for multiple
            DB::table('routes')->insert([
                'route' => $name,
                'controller' => "admin/parser/index_page/$name",
            ]);
        } else {
            DB::table('routes')->insert([
                'route' => $name,
                'controller' => "admin/parser/display/$insert_id/$entry_id",
            ]);
        }
    }

    public static function update($id, $fields)
    {
        //first let's clear the section_layout table for this section
        DB::table('section_layout')
            ->where('sectionid', '=', $id)
            ->delete();

        //Now amend
        $tmp_arr = explode(',', $fields);

        $counter = 0;
        foreach ($tmp_arr as $part) {
            DB::table('section_layout')->insert([
                'sectionid' => $id,
                'fieldid' => $part,
                'sortorder' => $counter,
            ]);
            $counter++;
        }
    }

    public static function destroy($id)
    {
        //first we must delete the routes (startsWith section_name)

        $sect = DB::table('section')
            ->where('id', '=', $id)
            ->limit(1)
            ->get();

        $section_name = $sect[0]->name;

        /*
        |---------------------------------------------------------------
        | WARNING using like might be unsafe to delete routes
        |---------------------------------------------------------------
        */

        DB::table('routes')
            ->where('route', 'like', $section_name.'%')
            ->delete();

        DB::table('section')
            ->where('id', '=', $id)
            ->delete();

        DB::table('section_layout')
            ->where('sectionid', '=', $id)
            ->delete();

        DB::table('entry')
            ->where('sectionid', '=', $id)
            ->delete();

        /*
        |---------------------------------------------------------------
        | Don't forget to remove directory files
        |---------------------------------------------------------------
        */

        Template_builder::remove_multiple($section_name);
        Template_builder::remove_single($section_name);
    }

    /*
    |---------------------------------------------------------------
    | Grab all the fields in use on the section, from section_layout
    |---------------------------------------------------------------
    */
    public static function fields_in_use($sectionid)
    {
        $all = DB::table('section_layout')
            ->join('fields', 'section_layout.fieldid', '=', 'fields.id')
            ->where('sectionid', '=', $sectionid)
            ->get();

        //dd( $all);
        return $all;
    }

    public static function fields_not_in_use($sectionid)
    {
        //refer to global function in helpers
    }
}

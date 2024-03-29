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

    //Checks if global section conflicts with matrix
    //necessary for template parser
    public static function doesGlobalConflictWithMatrix($globalName)
    {
        $query = DB::table('fields')
            ->select('*')
            ->where('type', '=', 'matrix')
            ->where('name', '=', $globalName)
            ->get();

        if ($query->count() > 0) {
            return true;
        } else {
            return false;
        }

    }

    /*
     * Update section permissions
     * i.e who can edit entry
     *
     *
     * @param   array $user_acess
     * @param   int $sectionid
     * @return  void
     */
    public static function sectionPermissions($user_access, $sectionid)
    {
        DB::table('section')
            ->where('id', '=', $sectionid)
            ->update([
                'user_access' => $user_access,
            ]);
    }

    /*
     * Get the section permissions
     * return as array
     *
     *
     * @param   int $sectionid
     * @return  array
     */
    public static function getPermissions($sectionid)
    {
        $query = DB::table('section')
            ->select('user_access')
            ->where('id', '=', $sectionid)
            ->limit(1)
            ->get();

        $csvArray = json_decode($query[0]->user_access);

        return $csvArray;

    }

    public static function getSectionType($sid)
    {
        $query = DB::table('section')
            ->select('sectiontype')
            ->where('id', '=', $sid)
            ->limit(1)
            ->get();

        return $query[0]->sectiontype;

    }

    /*
     * Create section, and if needed template
     *
     *
     * @param   string $name
     * @param   string $sectiontype
     * @param   csvarray $fields
     * @return  int $sectionid
     */
    public static function create(
        $name,
        $sectiontype,
        $fields
    ) {
        DB::table('section')->insert([
            'name' => $name,
            'sectiontype' => $sectiontype,
        ]);

        //Grab the insertid to use for section
        //layout
        $insert_id = DB::getPdo()->lastInsertId();

        //If template is true let's create it

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

        if ($sectiontype == 'multiple') {
            //do nothing
        } else {

            $userid = session('userid');

            DB::table('entry')->insert([
                'sectionid' => $insert_id,
                'type' => $sectiontype,
                'user_id' => $userid,
                'datecreated' => date('Y-m-d'),
            ]);

            $entry_id = DB::getPdo()->lastInsertId();
            //add a line to the content table
            //Beware of multiples
            DB::table('content')->insert([
                'entryid' => $entry_id,
            ]);
        }

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

        return $insert_id;
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

        Template_builder::removeMultiple($section_name);
        Template_builder::removeSingle($section_name);
    }

    /*
    |---------------------------------------------------------------
    | Grab all the fields in use on the section, from section_layout
    |---------------------------------------------------------------
    */
    public static function fieldsInUse($sectionid)
    {
        $all = DB::table('section_layout')
            ->join('fields', 'section_layout.fieldid', '=', 'fields.id')
            ->where('sectionid', '=', $sectionid)
            ->get();

        //dd( $all);
        return $all;
    }

    public static function fieldsNotInUse($sectionid)
    {
        //refer to global function in helpers
    }
}

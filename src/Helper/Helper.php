<?php
/*
|---------------------------------------------------------------
| Global helper functions for (views)
|---------------------------------------------------------------
|
| These functions can be called globally from anywhere in the
| application. Caution use globals sparingly!
|
| @author: IgnitedCMS
| @license: MIT
| @version: 1.0
| @since: 1.0
|
*/

namespace App\Helper;
use Illuminate\Support\Facades\DB;

class Helper
{
    public static function foo()
    {
        echo('bar');
    }
    /**
     * Field in section, used in section creation
     *
     * @param  string  $fieldid
     * @param  string  $sectionid
     * @return bool
     */
    public static function is_field_in_section($fieldid, $sectionid)
    {
        $rows = DB::table('section_layout')
            ->select('fieldid')
            ->where('fieldid', '=', $fieldid)
            ->where('sectionid', '=', $sectionid)
            ->get();

        //IMPORTANT logic is backward please fix
        if ($rows->count() > 0) {
            return false;
        } else {
            return true;
        }
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

    /**
     * Get the asset url
     *
     * @param  string  $assetit
     * @return string url
     */
    public static function get_asset($assetid)
    {
        $rows = DB::table('assetfields')
            ->select('url')
            ->where('id', '=', $assetid)
            ->get();

        if ($rows->count() > 0) {
            return $rows[0]->url;
        } else {
            return false;
        }
    }

    /**
     * Get the switch state 'checked'
     *
     * @param  string  $entryid
     * @param  string  $fieldname
     * @return string
     */
    public static function get_switch_state($entryid, $fieldname)
    {
        $rows = DB::table('content')
            ->select($fieldname)
            ->where('entryid', '=', $entryid)
            ->get();

        if ($rows[0]->$fieldname == '0') {
            return '';
        } else {
            return 'checked';
        }
    }

    /**
     * Get the entry title, used on multiple listings
     *
     * @param  string  $entryid
     * @return string  $entrytitle
     */
    public static function get_entrytitle($entryid)
    {
        $rows = DB::table('content')
            ->select('entrytitle')
            ->where('entryid', '=', $entryid)
            ->get();

        if (strlen($rows[0]->entrytitle) > 0) {
            return $rows[0]->entrytitle;
        } else {
            return 'No title';
        }
    }

    /**
     * Given sectionid check if type is a multiple
     * then provide conditional breadcrumbs and
     * entrytitle field
     *
     * @param  int  $sectionid
     * @return bool true or false
     */
    public static function is_multiple($sectionid)
    {
        $rows = DB::table('section')
            ->select('sectiontype')
            ->where('id', '=', $sectionid)
            ->limit(1)
            ->get();

        $type = $rows[0]->sectiontype;

        if ($type == 'multiple') {
            return true;
        } else {
            return false;
        }
    }

    /**
     * Given sectionid check if type is a single
     * then provide conditional breadcrumbs and
     * entrytitle field
     *
     * @param  int  $sectionid
     * @return bool true or false
     */
    public static function is_single($sectionid)
    {
        $rows = DB::table('section')
            ->select('sectiontype')
            ->where('id', '=', $sectionid)
            ->limit(1)
            ->get();

        $type = $rows[0]->sectiontype;

        if ($type == 'single') {
            return true;
        } else {
            return false;
        }
    }

    /*
     * Special function for builing dropdown markup
     *
     *
     * @param   int $entryid
     * @param   string $fieldname
     * @return  string  select markup
     */
    public static function build_dropdown($entryid, $fieldname)
    {
        //get saved content from db
        $saved_content = self::get_content($entryid, $fieldname);

        $rows = DB::table('fields')
            ->where('name', '=', $fieldname)
            ->limit(1)
            ->get();

        $line = $rows[0]->opts;

        $csv = explode(',', $line);

        foreach ($csv as $part) {
            if ($part == $saved_content) {
                echo "<option value='$part' selected>$part</option>";
                echo '<br>';
            } else {
                echo "<option value='$part'>$part</option>";
                echo '<br>';
            }
        }
    }

    /*
     * Special function for builing checkboxes
     *
     *
     * @param   int $entryid
     * @param   string $fieldname
     * @return  string  checkbox markup
     */
    public static function build_checkboxes($entryid, $fieldname)
    {
        //get saved content from db
        // Format "a,b,c"
        $saved_content = self::get_content($entryid, $fieldname);

        $csvarray = explode(',', $saved_content);
        /*
        |---------------------------------------------------------------
        | IMPORTANT edge case
        |---------------------------------------------------------------
        |
        | If not boxes are selected no POST data will be present to update
        | database
        |
        */

        $rows = DB::table('fields')
            ->where('name', '=', $fieldname)
            ->limit(1)
            ->get();

        $line = $rows[0]->opts;

        $csv = explode(',', $line);

        foreach ($csv as $part) {
            // add the word 'checked' to the end of the input markup!
            if (self::is_checked($part, $csvarray)) {
                echo "<input name='$fieldname"."[]'"." value='$part' type='checkbox' class='form-check-input' checked>";
                echo "<label for='$part'>$part</label>";
                echo '<br>';
            } else {
                echo "<input name='$fieldname"."[]'"." value='$part' type='checkbox' class='form-check-input'>";
                echo "<label for='$part'>$part</label>";
                echo '<br>';
            }
        }
    }

    /*
     * Test if checkbox is checked from saved content.
     * if it is, return true else return false
     *
     *
     * @param   string $checkbox_name
     * @param   array  $csvarray eg ['a','b']
     * @return  bool   true or false
     */
    public static function is_checked($checkbox_name, $csvarray)
    {
        $stopper = false;
        foreach ($csvarray as $row) {
            if ($checkbox_name == $row) {
                $stopper = true;
                break;
            } else {
                $stopper = false;
            }
        }

        return $stopper;
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

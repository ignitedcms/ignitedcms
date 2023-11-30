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
        echo 'bar';
    }

    //-----------------------------------------
    // Utility functions
    //-----------------------------------------

    /*
     |---------------------------------------------------------------
     | Checks to see if json payload is valid
     |---------------------------------------------------------------
     |
     | - all unique
     | - starts with a letter
     | - no spaces, or commas, slashes etc
     |
      */
    public static function valid_select($array)
    {
        $ar = [];
        foreach ($array as $var) {
            array_push($ar, $var->option);
        }

        $a = self::no_duplicates($ar);
        $b = self::valid_variable_names($ar);
        if ($a && $b) {
            return true;
        } else {
            return false;
        }
    }

    /*
    |---------------------------------------------------------------
    | Check if string is a valid variable name
    |---------------------------------------------------------------
    |
    | https://stackoverflow.com/questions/3980154/how-to-check-if-a-string-can-be-used-as-a-variable-name-in-php
    |
     */
    public static function valid_variable_names($ar)
    {
        $total_array = count($ar);
        $validate_count = 0;

        foreach ($ar as $key) {
            if (preg_match('/^[a-zA-Z_\x7f-\xff][a-zA-Z0-9_\x7f-\xff]*$/', $key)) {
                // the string is valid
                $validate_count++;
            }
        }
        if ($total_array === $validate_count) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * Check if valid csv string
     *
     *
     * @param  string  $str
     * @return    bool TRUE or FALSE
     */
    public static function is_valid_csv_string($str)
    {
        // $string = 'PHP,Java,"Py///&*thon",,,,,Swift';
        $data = str_getcsv($str);

        /*
        |---------------------------------------------------------------
        | Work by looping through array and checking the counts are equal
        |---------------------------------------------------------------
         */
        $total_array = count($data);
        $validate_count = 0;
        foreach ($data as $key) {
            // Also make sure string is only alphanumeric
            if (self::alpha_numeric($key)) {
                $validate_count++;
            }
        }
        if ($total_array === $validate_count) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * Alpha-numeric
     *
     * @param    string
     * @return    bool
     */
    public static function alpha_numeric($str)
    {
        return ctype_alnum((string) $str);
    }

    /*
     |---------------------------------------------------------------
     | Array utility Helpers below
     |---------------------------------------------------------------
      */

    /**
     * Not in array
     *
     * Checks if value isn't already in the array case insensitive
     * and if it isn't it returns TRUE
     *
     * @param  string  $val
     * @param  mixed  $arr array of values
     * @return    bool true or false
     */
    public static function not_in_array($val, $arr)
    {
        $pass = true;
        foreach ($arr as $key) {
            if (strtolower($val) == strtolower($key)) {
                $pass = false;
            }
        }

        return $pass;
    }

    /**
     * No duplicates
     *
     * Check if there are no duplicates in array (case insensitive)
     *
     * @param    mixed array $arr
     * @return    bool true or false
     */
    public static function no_duplicates($arr)
    {
        // First let's convert all to lower
        $arr_copy = [];
        foreach ($arr as $key) {
            /*
            |---------------------------------------------------------------
            | As a side note do a unit test to ensure strtolower
            | doesn't fail when array contains numeric datatypes
            |---------------------------------------------------------------
             */
            array_push($arr_copy, strtolower($key));
        }
        if (count(array_unique($arr_copy)) < count($arr_copy)) {
            // Array has duplicates
            return false;
        } else {
            // Array does not have duplicates
            return true;
        }
    }

    public static function check_permissions($permissionID, $map)
    {
        foreach ($map as $row) {
            if ($permissionID == $row->permissionID) {
                echo 'checked';
            }
        }
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

        if ($rows->count() > 0) {
            return true;
        } else {
            return false;
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

    public static function get_thumb($entryid, $fieldname)
    {
        $rows = DB::table('content')
            ->select($fieldname)
            ->where('entryid', '=', $entryid)
            ->get();

        $id = $rows[0]->$fieldname;

        $rows2 = DB::table('assetfields')
            ->select('thumb')
            ->where('id', '=', $id)
            ->get();

        if ($rows2->count() > 0) {
            return $rows2[0]->thumb;
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

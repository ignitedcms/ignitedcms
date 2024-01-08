<?php
/*
|---------------------------------------------------------------
| Global helper functions
|---------------------------------------------------------------
|
| Used in various files controllers and views
|
| @author: IgnitedCMS
| @license: MIT
| @version: 1.0
| @since: 1.0
*/

if (! function_exists('validSelect')) {
    function validSelect($array)
    {
        $ar = [];
        foreach ($array as $var) {
            array_push($ar, $var->option);
        }

        $a = noDuplicates($ar);
        $b = validVariableNames($ar);
        if ($a && $b) {
            return true;
        } else {
            return false;
        }
    }
}

if (! function_exists('validVariableNames')) {
    function validVariableNames($ar)
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
}

if (! function_exists('isValidCsvString')) {
    function isValidCsvString($str)
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
            if (alphaNumeric($key)) {
                $validate_count++;
            }
        }
        if ($total_array === $validate_count) {
            return true;
        } else {
            return false;
        }

    }
}

if (! function_exists('alphaNumeric')) {
    function alphaNumeric($str)
    {
        return ctype_alnum((string) $str);
    }
}

if (! function_exists('notInArray')) {
    function notInArray($val, $arr)
    {
        $pass = true;
        foreach ($arr as $key) {
            if (strtolower($val) == strtolower($key)) {
                $pass = false;
            }
        }

        return $pass;
    }
}

if (! function_exists('noDuplicates')) {
    function noDuplicates($arr)
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
}

if (! function_exists('checkPermissions')) {
    function checkPermissions($permissionID, $map)
    {
        foreach ($map as $row) {
            if ($permissionID == $row->permissionID) {
                echo 'checked';
            }
        }
    }
}

if (! function_exists('isFieldInSection')) {
    function isFieldInSection($fieldid, $sectionid)
    {
        $rows = DB::table('section_layout')
            ->select('fieldid')
            ->where('fieldid', '=', $fieldid)
            ->where('sectionid', '=', $sectionid)
            ->get();

        if ($rows->count() > 0) {
            return false;
        } else {
            return true;
        }
    }
}

if (! function_exists('getContent')) {
    function getContent($entryid, $fieldname)
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
}

if (! function_exists('getThumb')) {
    function getThumb($entryid, $fieldname)
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
}

if (! function_exists('getAsset')) {
    function getAsset($assetid)
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
}

if (! function_exists('getSwitchState')) {
    function getSwitchState($entryid, $fieldname)
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
}

if (! function_exists('getEntrytitle')) {
    function getEntrytitle($entryid)
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
}

if (! function_exists('isMultiple')) {
    function isMultiple($sectionid)
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
}

if (! function_exists('isSingle')) {
    function isSingle($sectionid)
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
}

if (! function_exists('buildDropdown')) {

    function buildDropdown($entryid, $fieldname)
    {
        //get saved content from db
        $saved_content = getContent($entryid, $fieldname);

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
}

if (! function_exists('buildCheckboxes')) {

    function buildCheckboxes($entryid, $fieldname)
    {        //get saved content from db
        // Format "a,b,c"
        $saved_content = getContent($entryid, $fieldname);

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
            if (isChecked($part, $csvarray)) {
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
}

if (! function_exists('isChecked')) {
    function isChecked($checkbox_name, $csvarray)
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
}

if (! function_exists('getSectionName')) {
    function getSectionName($sectionid)
    {
        $data = DB::table('section')
            ->where('id', '=', $sectionid)
            ->select('name')
            ->limit(1)
            ->get();

        return $data[0]->name;
    }
}

if (! function_exists('sidebarGuard')) {
    function sidebarGuard($arg)
    {
               //get userid from session and return all
        //controllers they have access to
        $userid = session('userid');
        $row = DB::table('user')
            ->select('permissiongroup')
            ->where('id', '=', $userid)
            ->limit(1)
            ->get();

        $permissiongroup = $row[0]->permissiongroup;

        //now get all from permission map
        $rows = DB::table('permission_map')
            ->select('permissionID')
            ->where('groupID', '=', $permissiongroup)
            ->orderBy('permissionID', 'asc')
            ->get();

        $pass = false;
        foreach ($rows as $row) {
            if ($arg == $row->permissionID) {
                $pass = true;
                break;
            }
        }

        return $pass;

    }
}

/*                                                                          
|---------------------------------------------------------------            
| Matrix helper remove later
|---------------------------------------------------------------            
*/       

if (!function_exists('not_empty'))
{
	function not_empty($name, $array)
	{
		$val = false;
		foreach ($array->content as $key)
		{
			if ($key->title === $name)
			{
				if (strlen($key->content) > 0)
				{
					$val = true;
				}
				else
				{
					$val = false;
				}
			}
		}
		return $val;
	}
}

if (!function_exists('print_content'))
{
	function print_content($name, $array)
	{
		foreach ($array->content as $key)
		{
			if ($key->title == $name)
			{
            if($key->type == 'check-box')
            {
               $array = $key->checkedValues;
               array_shift($array);
               return $array;
            }
				return $key->content;
			}
		}
	}
}

if (!function_exists('print_title'))
{
	function print_title($name, $array)
	{
		foreach ($array->content as $key)
		{
			if ($key->title == $name)
			{
				return $key->alttitle;
			}
		}
	}
}


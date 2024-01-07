<?php

/*
|---------------------------------------------------------------
| Global helper functions
|---------------------------------------------------------------
|
| Used in various files controllers and views
|
*/

if (! function_exists('validSelect')) {
    function validSelect($array)
    {
        $ar = [];
        foreach ($array as $var) {
            array_push($ar, $var->option);
        }

        $a = self::noDuplicates($ar);
        $b = self::validVariableNames($ar);
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
            if (self::alphaNumeric($key)) {
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

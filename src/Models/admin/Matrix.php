<?php
/*
|---------------------------------------------------------------
| Matrix model
|---------------------------------------------------------------
|
|
| @author: IgnitedCMS
| @license: MIT
| @version: 1.0
| @since: 1.0
*/

namespace Ignitedcms\Ignitedcms\Models\admin;

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class Matrix
{
    /**
     *  @Description: Add new matrix fields to database
     *
     *       @Params: $matrix_name, json
     *
     *    @returns: nothing
     */
    public static function add_matrix($matrix_name, $data)
    {

        //NEED to use JSON.stringify and json_decode for quotes bug on
        //true and false values

        DB::table('fields')->insertGetId([
            'name' => $matrix_name,
            'type' => 'matrix',
            'opts' => json_decode($data),
            'instructions' => 'instructions',
            'maxchars' => '',
            'formvalidation' => 'min_length[1]', //WARNING
        ]);

        /*
        |---------------------------------------------------------------
        | Now let's add a column for this in the content table
        | We need to pass this variable in as an anonymous fun
        |---------------------------------------------------------------
        */
        Schema::table('content', function (Blueprint $table) use ($matrix_name) {
            $table->text($matrix_name)->nullable();
        });

    }

    /**
     *  @Description: get matrix content for entry id
     *
     *       @Params: sectionid,entryid
     *
     *       @returns: json array (section may have more than one matrix)
     */
    public static function get_matrix($sectionid, $entryid)
    {

        //get all the fields
        $matrix = '';
        $query = DB::table('section_layout')
            ->select('*')
            ->where('sectionid', '=', $sectionid)
            ->get();

        foreach ($query as $row) {
            if (self::is_matrix($row->fieldid)) {
                //use my_helper functions to exact
                $fieldname = self::get_fieldname($row->fieldid);
                $content = self::get_content($entryid, $fieldname);

                //remove script tags
                $content = str_ireplace('<script>', '', $content);
                $content = str_ireplace('</script>', '', $content);

                //remove first and last characters [,]
                $matrix = substr($content, 1, -1);
            }
        }

        return $matrix;
    }

    /*
     * Get the fieldname
     *
     *
     * @param   int $fieldid
     * @return  string $fieldname
     */
    public static function get_fieldname($fieldid)
    {
        $rows = DB::table('fields')
            ->select('name')
            ->where('id', '=', $fieldid)
            ->get();

        return $rows[0]->name;

    }

    /*
     * Get the content
     *
     *
     * @param   int $entryid
     * @param   string $fieldname
     * @return  string $contents
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
     *  @Description: check if field id is matrix depends on func above (get_matrix)
     *
     *       @Params: fieldid
     *
     *       @returns: true or false
     */
    public static function is_matrix($fieldid)
    {

        $query = DB::table('fields')
            ->select('type')
            ->where('id', '=', $fieldid)
            ->limit(1)
            ->get();

        $pass = 0;
        foreach ($query as $row) {
            if ($row->type == 'matrix') {
                $pass = 1;
            }
        }

        return $pass;
    }

    /**
     * Get a list of all the fieldnames from json matrixContent
     *
     *
     * @param  jsonarray  $jsonMatrix
     * @return	array  returns an array of all the fieldnames
     */
    public static function get_fieldnames($jsonMatrix)
    {
        // true flag sets results as assoc array
        // flase flag sets results as object
        // $tmp = json_decode($jsonMatrix,true);
        $arr = [];

        //Needed for first item as it should be empty
        if ($jsonMatrix == null) {
            return $arr;
        } else {
            foreach ($jsonMatrix as $key) {
                array_push($arr, $key['title']);
            }

            // $tmp = array('a','b','c');
            return $arr;

        }

    }

    /**
     * Get a list of all the variations from json matrixContent
     *
     * For use on check-box drop-down and file-upload types
     *
     * @param  string  $comma_string
     * @return	array  returns an array of all the variations
     */
    public static function get_variations($comma_string)
    {
        $tmp = explode(',', $comma_string);
        $arr = [];
        foreach ($tmp as $key) {
            array_push($arr, $key);
        }

        return $arr;
    }
}

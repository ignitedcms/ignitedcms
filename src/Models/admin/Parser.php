<?php
/*
|---------------------------------------------------------------
| Parser model
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

class Parser
{
    /*
     * Does what it says on tin, gets all globals vars
     *
     *
     * @return  array $globals
     */
    public static function get_globals()
    {
        //loop through entry's and select global types
        $query = DB::table('entry')
            ->where('type', 'global')
            ->select('*')
            ->get();

        $arr = [];
        foreach ($query as $row) {
            $name = self::get_section_name($row->sectionid);

            $query2 = DB::table('content')
                ->where('entryid', $row->id)
                ->select('*')
                ->get();

            //convert to an array
            $query2 = $query2->toArray();

            foreach ($query2 as $key) {
                foreach ($key as $field_name => $field_content) {
                    $tmp = self::for_image($field_name, $field_content);

                    $arr[$name][$field_name] = $tmp;
                }
            }
        }

        return $arr;
    }

    /*
     * Get the root level multiple
     *
     *
     * @param   string $sectionname
     * @return  void
     */
    public static function get_multiples($section_name)
    {
        //First let's collect all the globals
        $data = [];
        $arr = self::get_globals();
        foreach ($arr as $key => $value) {
            $data[$key] = $value;
        }

        /*
        |---------------------------------------------------------------
        | Finally lets grab all the multiples
        |---------------------------------------------------------------
        */
        $query = DB::table('section')
            ->join('entry', 'section.id', '=', 'entry.sectionid')
            ->where('entry.type', '=', 'multiple')
            ->where('section.name', '=', $section_name)
            ->select('section.name', 'entry.id', 'entry.sectionid')
            ->orderBy('sort_order')
            ->get();

        $arr = [];
        $counter = 0;
        foreach ($query as $row) {

            $url = self::get_route($row->id, $row->sectionid);
            $a['url'] = $url; //for ease of use save url

            $query2 = DB::table('content')
                ->select('*')
                ->where('entryid', '=', $row->id)
                ->limit(1)
                ->get();

            $query2 = $query2->toArray();

            $arrTmp = [];
            foreach ($query2 as $b) {
                $arrTmp = $b;
            }

            foreach ($arrTmp as $key => $value) {
                //special case for images
                //make templating much easier
                $tmp = self::for_image($key, $value);
                //$tmp = $this->for_image($key, $value);

                $a[$key] = $tmp;
            }
            //////////////////////////////////////

            $arr[$section_name][$counter] = $a;
            $counter++;
        }
        $data['multiples'] = $arr;

        return $data;

    }

    //save a url for each multiple in array
    public static function get_route($entryid, $sectionid)
    {
        $string = "admin/parser/display/$sectionid/$entryid";

        $query = DB::table('routes')
            ->select('route')
            ->where('controller', '=', $string)
            ->limit(1)
            ->get();

        $route = '';
        foreach ($query as $row) {
            $route = $row->route;
        }

        return $route;
    }

    public static function get_single($sectionid, $entryid)
    {
        $query = DB::table('content')
            ->select('*')
            ->from('content')
            ->where('entryid', $entryid)
            ->limit(1)
            ->get();

        $query = $query->toArray();

        $arrTmp = [];
        foreach ($query as $row) {
            $arrTmp = $row;
        }

        $data = [];
        //store all these in the entry array
        foreach ($arrTmp as $key => $value) {
            //special case for images
            //make templating much easier
            $tmp = self::for_image($key, $value);

            $data[$key] = $tmp;
        }

        //now get the globals
        $arr = self::get_globals();
        foreach ($arr as $key => $value) {
            $data[$key] = $value;
        }

        return $data;
    }

    public static function for_image($col, $val)
    {
        $col = trim($col);

        $query = DB::table('fields')
            ->select('*')
            ->where('name', '=', $col)
            ->limit(1)
            ->get();

        $type = '';
        foreach ($query as $row) {
            $type = $row->type;
        }

        if ($type == 'file-upload') {

            $query = DB::table('assetfields')
                ->select('url')
                ->where('id', '=', $val)
                ->limit(1)
                ->get();

            $url = '';
            foreach ($query as $row) {
                $url = $row->url;
            }

            return $url;

        } elseif ($type == 'matrix') {

            $arr = [];
            $counter = 0; //needed to loop!

            $json = json_decode($val);

            foreach ($json as $key) {
                $titre = $json[0]->title;
                $counter++;
                foreach ($key->content as $r) {
                    if ($r->type != 'check-box') {
                        $b[$counter][$r->title] = $r->content;
                        array_push($arr, $b);

                    } else {
                        //nothing in content so dump checkedvalues
                        $b[$counter][$r->title] = json_encode($r->checkedValues);
                        array_push($arr, $b);

                    }

                }
            }

            return $b;

        } else {
            return $val;
        }
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

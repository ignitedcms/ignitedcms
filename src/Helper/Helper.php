<?php
/*
|---------------------------------------------------------------
| Global helper functions
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
}

<?php
/*
|---------------------------------------------------------------
| Parser controller
|---------------------------------------------------------------
|
| Grabs all the content for the entry and renders to view.
| Additionally this auto maps the routes from the database
|
| @author: IgnitedCMS
| @license: MIT
| @version: 1.0
| @since: 1.0
*/

namespace Ignitedcms\Ignitedcms\Http\Controllers\admin;

//use App\Http\Controllers\Controller;
// don't need auth middleware as public
use Ignitedcms\Ignitedcms\Models\admin\Parser;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;

class ParserController extends Controller
{
    public function __construct()
    {
        //no middleware as these are public GET routes
    }

    /*
     * Given singles get content
     * This also works for multiple entries
     *
     *
     * @param   int $sectionid
     * @param   int $entryid
     * @return  void
     */
    public function display($sid, $eid)
    {
        //Thus we need to pass all globals
        //to any page at all times

        $data = Parser::getSingle($sid, $eid);

        if (self::isMultiple($sid)) {

            // Get section name
            $section_name = Parser::getSectionName($sid);

            return view("custom.$section_name.entry")->with($data);
        } else {
            //is Single type

            $section_name = Parser::getSectionName($sid);

            return view("custom.$section_name")->with($data);
        }
    }

    /*
     * A special method for dealing with root multiples
     *
     *
     * @param   string $sectionname
     * @return  void
     */
    public function index_page($section_name)
    {
        $data = Parser::getMultiples($section_name);

        return view("custom.$section_name.index", $data);
    }

    public static function isMultiple($sectionid)
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

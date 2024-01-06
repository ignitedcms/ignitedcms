<?php
/*
|---------------------------------------------------------------
| Entry controller
|---------------------------------------------------------------
|
| Performs validation for adding entries, singles, multiples
| and globals
|
| @author: IgnitedCMS
| @license: MIT
| @version: 1.0
| @since: 1.0
*/

namespace Ignitedcms\Ignitedcms\Http\Controllers\admin;

//use App\Http\Controllers\Controller;
use Ignitedcms\Ignitedcms\Http\Middleware\Igs_auth;
use Ignitedcms\Ignitedcms\Models\admin\Asset;
use Ignitedcms\Ignitedcms\Models\admin\Entry;
use Ignitedcms\Ignitedcms\Models\admin\Matrix;
use Ignitedcms\Ignitedcms\Models\admin\Template_builder;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class EntryController extends Controller
{
    public function __construct()
    {
        $this->middleware(Igs_auth::class.':15');
    }

    public function index()
    {
        $data = Entry::single();
        $data2 = Entry::multiple();
        $data3 = Entry::globals();

        $assets = Asset::all(); //quick fix for vue component

        //We also need to pass a blank matrix to the layout
        $matrix = '[]';
        $singleRichtext = '[]';

        return view('ignitedcms::admin.entry.index')->with([
            'data' => $data,
            'data2' => $data2,
            'data3' => $data3,
            'assets' => $assets,
            'matrix' => $matrix,
            'singleRichtext' => $singleRichtext,
        ]);
    }

    /*
     * Write single template to view directory
     *
     *
     * @param   int $sectionid
     * @param   int $entryid
     * @return  void Writes files
     */
    public function buildSingle($sid, $eid)
    {
        Template_builder::buildSingle($sid, $eid);

        return redirect("admin/entry/update/$sid/$eid");

    }

    /*
     * Write folder AND file for multiples
     *
     *
     * @param   int $sectionid
     * @return  void Writes folder and files
     */
    public function buildMultiple($sid)
    {
        Template_builder::buildMultiple($sid);

        return redirect("admin/multiple/$sid");
        //redirect
    }

    public function updateView($sectionid, $entryid)
    {
        $data = Entry::sectionAllFields($sectionid);
        $assets = Asset::all();

        $matrix = Matrix::getMatrix($sectionid, $entryid);

        //Pass the single rich text boxes to footer, for vuejs!!!!
        $singleRichtext = Entry::getSingleRichtextfields($sectionid, $entryid);

        return view('ignitedcms::admin.entry.edit')->with([
            'data' => $data,
            'assets' => $assets,
            'entryid' => $entryid,
            'sectionid' => $sectionid,
            'matrix' => $matrix,
            'singleRichtext' => $singleRichtext,
        ]);
    }

    //big task evaulating
    //Save input into content table
    //update as entryid already created
    public function update(Request $request, $sectionid, $entryid)
    {
        $data = Entry::sectionAllFields($sectionid);


        /*
        |---------------------------------------------------------------
        | Now loop through the fields and save the POST data
        |---------------------------------------------------------------
        |
        | Saving is fine except for checkboxes . . .
        */

        //get the userid
        $userid = session('userid');

        foreach ($data as $row) {
            if ($row->type != 'check-box') {
                //not a checkbox all good save to db
                $postdata = $request->input($row->name);
                Entry::saveToContent($userid, $entryid, $row->name, $postdata);
            } else {
                $postdata = $request->input($row->name);
                if ($postdata == null) {
                    //no postdata so save a blank string to db
                    Entry::saveToContent($userid, $entryid, $row->name, '');
                } else {
                    //postdata true so format to csv and
                    //save to db
                    $csv = Entry::checkboxFormat($postdata);
                    Entry::saveToContent($userid, $entryid, $row->name, $csv);
                }
            }
        }

        return redirect("admin/entry/update/$sectionid/$entryid")->with('status', 'Saved successfully');
    }
}

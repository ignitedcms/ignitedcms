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
use Ignitedcms\Ignitedcms\Rules\Uniquemultiple;
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
        $matrix = '';
        $singleRichtext = '';

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
    public function build_single($sid, $eid)
    {
        Template_builder::build_single($sid, $eid);

        return redirect("admin/entry/update/$sid/$eid");

    }

    /*
     * Write folder AND file for multiples
     *
     *
     * @param   int $sectionid
     * @return  void Writes folder and files
     */
    public function build_multiple($sid)
    {
        Template_builder::build_multiple($sid);

        return redirect("admin/multiple/$sid");
        //redirect
    }

    public function update_view($sectionid, $entryid)
    {
        $data = Entry::section_all_fields($sectionid);
        $assets = Asset::all();

        $matrix = Matrix::get_matrix($sectionid, $entryid);

        //Pass the single rich text boxes to footer, for vuejs!!!!
        $singleRichtext =  Entry::get_single_richtextfields($sectionid, $entryid);

        return view('ignitedcms::admin.entry.edit')->with([
            'data' => $data,
            'assets' => $assets,
            'entryid' => $entryid,
            'sectionid' => $sectionid,
            'matrix' => $matrix,
            'singleRichtext'=> $singleRichtext
        ]);
    }

    //big task evaulating
    //Save input into content table
    //update as entryid already created
    public function update(Request $request, $sectionid, $entryid)
    {
        $data = Entry::section_all_fields($sectionid);

        /*
        |---------------------------------------------------------------
        | Check if multiple
        |---------------------------------------------------------------
        |
        | If true we need to save the entrytitle POST data
        |
        */

        $entrytitle = $request->input('entrytitle');

        $sectionname = Entry::get_section_name($sectionid);
        if ($entrytitle != null) {
            $validated = $request->validate([
                'entrytitle' => [
                    'required',
                    'min:1',
                    new Uniquemultiple($sectionname),
                    'regex:/^(?!-)(?!.*--)[a-z-]+(?<!-)$/',
                ],

            ]);
            Entry::save_to_content_as_multiple($entryid, $entrytitle);
        }

        /*
        |---------------------------------------------------------------
        | Now loop through the fields and save the POST data
        |---------------------------------------------------------------
        |
        | Saving is fine except for checkboxes . . .
        |
        |
        */

        foreach ($data as $row) {
            if ($row->type != 'check-box') {
                //not a checkbox all good save to db
                $postdata = $request->input($row->name);
                Entry::save_to_content($entryid, $row->name, $postdata);
            } else {
                $postdata = $request->input($row->name);
                if ($postdata == null) {
                    //no postdata so save a blank string to db
                    Entry::save_to_content($entryid, $row->name, '');
                } else {
                    //postdata true so format to csv and
                    //save to db
                    $csv = Entry::checkbox_format($postdata);
                    Entry::save_to_content($entryid, $row->name, $csv);
                }
            }
        }

        return redirect("admin/entry/update/$sectionid/$entryid")->with('status', 'Saved successfully');
    }
}

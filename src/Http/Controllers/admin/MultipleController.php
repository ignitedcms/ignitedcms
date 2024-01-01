<?php
/*
|---------------------------------------------------------------
| Multiple controller
|---------------------------------------------------------------
|
| Performs all logic for multiples (section type_
|
|
| @author: IgnitedCMS
| @license: MIT
| @version: 1.0
| @since: 1.0
*/

namespace Ignitedcms\Ignitedcms\Http\Controllers\admin;

//use App\Http\Controllers\Controller;
use Ignitedcms\Ignitedcms\Http\Middleware\Igs_auth;
use Ignitedcms\Ignitedcms\Models\admin\Entry;
use Ignitedcms\Ignitedcms\Models\admin\Multiple;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Validator;

class MultipleController extends Controller
{
    public function __construct()
    {
        $this->middleware(Igs_auth::class.':15');
    }

    //Get a specific multiple
    public function index($sectionid)
    {
        $data = Multiple::all($sectionid);

        $sectionname = Multiple::getSectionName($sectionid);

        return view('ignitedcms::admin.entry.multiple.index')->with([

            'data' => $data,
            'sectionid' => $sectionid,
            'sectionname' => $sectionname,
        ]);
    }

    /*
     * Search and filter multiples
     *
     *
     * @param   int $sectionid
     * @param   string $searchQuery POST
     * @return  array search matches
     */
    public function search(Request $request, $sectionid)
    {
        $searchQuery = $request->input('searchQuery');

        $data = Multiple::search($sectionid, $searchQuery);

        $sectionname = Multiple::getSectionName($sectionid);

        return view('ignitedcms::admin.entry.multiple.index')->with([

            'data' => $data,
            'sectionid' => $sectionid,
            'sectionname' => $sectionname,
        ]);
    }

    //create a new entry for multiple by section id
    //modal
    public function create(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'entrytitle' => [
                'required',
                'min:1',
                'regex:/^(?!-)(?!.*--)[a-z-]+(?<!-)$/',
            ],
        ]);

        if ($validator->fails()) {

            echo $validator->errors();
        } else {

            $entrytitle = $request->input('entrytitle');
            $sectionid = $request->input('sectionid');
            $sectionname = Multiple::getSectionName($sectionid);
            $route = "$sectionname/$entrytitle";

            if (Multiple::isDuplicateRoute($route)) {
                echo 'You cannot have a duplicate entry title';
            } else {

                $entrytitle = $request->input('entrytitle');

                Multiple::create($sectionid, $entrytitle);

                echo 'success';
            }
        }

    }

    public function update()
    {

    }

    //ajax post request
    //needs csrf token!!
    public function orderMultiples(Request $request)
    {
        //quick and dirty json test
        $data = $request->input('items');
        //now order these!

        $counter = 0;
        foreach ($data as $row) {
            Multiple::order($row['id'], $counter);
            $counter++;
        }

        return response()->json(['message' => 'Sorted successfully']);
    }

    public function updateView($sectionid, $entryid)
    {
        $data = Entry::sectionAllFields($sectionid);

        return view('ignitedcms::admin.entry.multiple.edit')->with([
            'data' => $data,
            'entryid' => $entryid,
        ]);
    }

    public function destroy(Request $request, $sid)
    {
        $ids = $request->input('id');

        if ($ids == null) {

            return redirect("admin/multiple/$sid")
                ->with('error', 'Nothing selected, nothing to delete');
        } else {

            //Now let's loop through and remove entryid
            foreach ($ids as $id) {
                Multiple::delete($sid, $id);
            }

            return redirect("admin/multiple/$sid")
                ->with('status', 'Entry deleted');
        }

    }
}

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

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Http\Middleware\Igs_auth;
use App\Models\admin\Entry;
use App\Models\admin\Multiple;
use Illuminate\Http\Request;

class MultipleController extends Controller
{
    public function __construct()
    {
        $this->middleware(Igs_auth::class);
    }

    //Get a specific multiple
    public function index($sectionid)
    {
        $data = Multiple::all($sectionid);

        $sectionname = Multiple::get_section_name($sectionid);

        return view('admin.entry.multiple.index')->with([

            'data' => $data,
            'sectionid' => $sectionid,
            'sectionname' => $sectionname,
        ]);
    }

    //create a new entry for multiple by section id
    public function create($sectionid)
    {
        Multiple::create($sectionid);

        return redirect("admin/multiple/$sectionid")
            ->with('status', 'New entry created');
    }

    public function update()
    {

    }

    //ajax post request
    //needs csrf token!!
    public function order_multiples(Request $request)
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

    public function update_view($sectionid, $entryid)
    {
        $data = Entry::section_all_fields($sectionid);

        return view('admin.entry.multiple.edit')->with([
            'data' => $data,
            'entryid' => $entryid,
        ]);
    }

    public function destroy(Request $request, $sid)
    {
        $ids = $request->input('id');

        //Now let's loop through and remove entryid
        foreach ($ids as $id) {
            Multiple::delete($sid, $id);
        }

        return redirect("admin/multiple/$sid")
            ->with('status', 'Entry deleted');
    }
}

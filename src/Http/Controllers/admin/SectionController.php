<?php
/*
|---------------------------------------------------------------
| Section controller
|---------------------------------------------------------------
|
| Performs all the logic for adding removing sections
| Mainly for 'singles' and 'globals', multiples are
| handled in the Multiple controllerk
|
| @author: IgnitedCMS
| @license: MIT
| @version: 1.0
| @since: 1.0
*/

namespace Ignitedcms\Ignitedcms\Http\Controllers\admin;

//use App\Http\Controllers\Controller;
use Ignitedcms\Ignitedcms\Http\Middleware\Igs_auth;
use Ignitedcms\Ignitedcms\Models\admin\Fields;
use Ignitedcms\Ignitedcms\Models\admin\Section;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class SectionController extends Controller
{
    public function __construct()
    {
        $this->middleware(Igs_auth::class.':14');
    }

    public function index()
    {
        $data = Section::all();
        $fields = Fields::all();

        //dd($fields);

        return view('ignitedcms::admin.sections.index')->with([
            'data' => $data,
            'fields' => $fields,
        ]);
    }

   public function create(Request $request)
   {
       $validated = $request->validate([
           'name' => [
               'required',
               'lowercase',
               'min:1',
               'regex:/^(?!-)(?!.*--)[a-z-]+(?<!-)$/',
               'unique:section',
           ],
           'sectiontype' => 'required',
           'order' => 'required',
       ]);

       $name = $request->input('name');
       $sectiontype = $request->input('sectiontype');
       $fields = $request->input('order');

       if ($sectiontype == 'global' && Section::doesGlobalConflictWithMatrix($name)) {
           return redirect('admin/section')->with('error', 'Failed matrix conflict');
       }

       Section::create($name, $sectiontype, $fields);

       return redirect('admin/section')->with('status', 'Section created');
   }

    public function createView()
    {
        /*
        |---------------------------------------------------------------
        | Let's pass in all the available fields to the view
        |---------------------------------------------------------------
        */

        $data = Fields::all();

        return view('ignitedcms::admin.sections.create')->with('data', $data);
    }

    // We need to list all fields - used fields
    // and pass this to the view
    public function updateView($id)
    {
        $data = Fields::all();
        $data2 = Section::read($id);

        //left  pills
        $data3 = Section::fieldsInUse($id);

        //right pills
        $data4 = Section::fieldsNotInUse($id);

        return view('ignitedcms::admin.sections.edit')->with([
            'id' => $id,
            'data' => $data,
            'data2' => $data2,
            'data3' => $data3,
        ]);
    }

    //Just update the fields if changed
    public function update(Request $request, $id)
    {

        $validated = $request->validate([

            'order' => 'required',

        ]);
        $fields = $request->input('order');

        Section::update($id, $fields);

        return redirect('admin/section')->with('status', 'Section updated');

    }

    public function destroy($id)
    {
        Section::destroy($id);

        return redirect('admin/section')->with('status', 'Section deleted');
    }
}

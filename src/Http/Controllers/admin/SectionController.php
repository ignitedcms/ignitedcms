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

use Ignitedcms\Ignitedcms\Http\Middleware\Igs_auth;
use Ignitedcms\Ignitedcms\Models\admin\Fields;
use Ignitedcms\Ignitedcms\Models\admin\Section;
use Ignitedcms\Ignitedcms\Models\admin\Template_builder;
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
            'template' => '',
        ]);

        //null or on
        $template = $request->input('template');
        $sectiontype = $request->input('sectiontype');

        $name = $request->input('name');
        $fields = $request->input('order');

        if ($sectiontype == 'global' && Section::doesGlobalConflictWithMatrix($name)) {
            return redirect('admin/section')->with('error', 'Failed matrix conflict');
        }

        $sid = Section::create($name, $sectiontype, $fields);

        //Let's build the template if selected
        if ($template == 'on') {
            if ($sectiontype == 'single') {
                Template_builder::buildSingle($sid);
            }

            if ($sectiontype == 'multiple') {
                Template_builder::buildMultiple($sid);
            }
        }

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

        //Let's build template if needed
        $template = $request->input('template');
        $sectiontype = Section::getSectionType($id);

        if ($template == 'on') {
            if ($sectiontype == 'single') {
                Template_builder::buildSingle($id);
            }

            if ($sectiontype == 'multiple') {
                Template_builder::buildMultiple($id);
            }
        }

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

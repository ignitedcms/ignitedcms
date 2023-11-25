<?php
/*
|---------------------------------------------------------------
| Field controller
|---------------------------------------------------------------
|
| Performs validation for adding custom fields
|
|
| @author: IgnitedCMS
| @license: MIT
| @version: 1.0
| @since: 1.0
*/

namespace Ignitedcms\Ignitedcms\Http\Controllers\admin;

//use App\Http\Controllers\Controller;
use Illuminate\Routing\Controller;

use Ignitedcms\Ignitedcms\Http\Middleware\Igs_auth;
use Ignitedcms\Ignitedcms\Models\admin\Fields;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class FieldsController extends Controller
{
    public function __construct()
    {
        $this->middleware(Igs_auth::class);
    }

    public function index()
    {
        $data = Fields::all();

        return view('ignitedcms::admin.fields.index')->with('data', $data);
    }

    public function create(Request $request)
    {
        $validated = $request->validate([
            'name' => [
                'required',
                'lowercase',
                'alpha:ascii',
                'unique:fields',
                Rule::notIn(['url', 'content', 'id', 'section', 'field',
                    'entryid', 'entrytitle']),
            ],

            'instructions' => '',
            'type' => 'required',
            'length' => 'integer',
            'variations' => '',
        ]);

        $name = $request->input('name');
        $instructions = $request->input('instructions');
        $type = $request->input('type');
        $length = $request->input('length');
        $variations = $request->input('variations');

        /*
        |---------------------------------------------------------------
        | Special case for form validation column
        |---------------------------------------------------------------
        */
        $form_validation = '';

        if ($type == 'plain-text') {
            $form_validation = "max:$length";
        } elseif ($type == 'multi-line') {
            $form_validation = '';
        } elseif ($type == 'rich-text') {
            $form_validation = '';
        } elseif ($type == 'drop-down') {
            $form_validation = '';
        } else {
            $form_validation = '';
        }

        Fields::create(
            $name,
            $instructions,
            $type,
            $length,
            $variations,
            $form_validation
        );

        return redirect('admin/fields');
    }

    public function create_view()
    {
        return view('ignitedcms::admin.fields.create');
    }

    // disable editing
    public function update(Request $request, $id)
    {
        //Fields::update();
    }

    public function update_view(Request $request, $id)
    {
        $data = Fields::update($id);

        return view('ignitedcms::admin.fields.edit')->with('data', $data);
    }

    public function destroy(Request $request, $id)
    {
        Fields::destroy($id);

        return redirect('admin/fields');
    }
}

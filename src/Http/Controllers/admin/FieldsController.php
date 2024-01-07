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

use Ignitedcms\Ignitedcms\Http\Middleware\Igs_auth;
use Ignitedcms\Ignitedcms\Models\admin\Fields;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class FieldsController extends Controller
{
    public function __construct()
    {

        $this->middleware(Igs_auth::class.':13');
    }

    public function index()
    {
        $data = Fields::all();

        return view('ignitedcms::admin.fields.index')->with('data', $data);
    }

    public function create(Request $request)
    {
        $validator = Validator::make($request->all(), [

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

        if ($validator->fails()) {
            return response()->json($validator->errors());
        }

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
        $formValidation = '';

        /*
        |---------------------------------------------------------------
        | Here we need to sanity check csv on variations
        |---------------------------------------------------------------
        */
        $csvCheck = true;

        if ($type == 'plain-text') {
            $formValidation = "max:$length";
        } elseif ($type == 'multi-line') {
            $formValidation = '';
        } elseif ($type == 'rich-text') {
            $formValidation = '';
        } elseif ($type == 'drop-down') {
            $csvCheck = isValidCsvString($variations);
            $formValidation = '';
        } elseif ($type == 'check-box') {
            $csvCheck = isValidCsvString($variations);
            $formValidation = '';
        } elseif ($type == 'file-upload') {
            $csvCheck = isValidCsvString($variations);
            $formValidation = '';
        } else {
            $formValidation = '';
        }

        if ($csvCheck) {

            Fields::create(
                $name,
                $instructions,
                $type,
                $length,
                $variations,
                $formValidation
            );

            return response()->json('success');
        } else {

            return response()->json('Invalid csv string');
        }

    }

    public function createView()
    {
        return view('ignitedcms::admin.fields.create');
    }

    // disable editing
    public function update(Request $request, $id)
    {
        //Fields::update();
    }

    public function updateView(Request $request, $id)
    {
        $data = Fields::update($id);

        return view('ignitedcms::admin.fields.edit')->with('data', $data);
    }

    public function destroy(Request $request, $id)
    {
        Fields::destroy($id);

        return redirect('admin/fields')->with('status', 'Field deleted successfully');
    }
}

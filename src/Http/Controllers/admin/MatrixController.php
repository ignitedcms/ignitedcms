<?php
/*
|---------------------------------------------------------------
| Matrix controller
|---------------------------------------------------------------
|
| Performs specific actions in regards to the matrix field
| type
|
*/

namespace Ignitedcms\Ignitedcms\Http\Controllers\admin;

use Helper;
use Ignitedcms\Ignitedcms\Http\Middleware\Igs_auth;
use Ignitedcms\Ignitedcms\Models\admin\Fields;
use Ignitedcms\Ignitedcms\Models\admin\Matrix;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class MatrixController extends Controller
{
    public function __construct()
    {
        $this->middleware(Igs_auth::class.':13');
    }

    public function create_view()
    {
        $data = 'Matrix';

        return view('ignitedcms::admin.matrix.create')->with([
            'data' => $data,
        ]);
    }

    public function create(Request $request)
    {
        $matrix_name = $request->input('matrix_name');

        /*                                                                          
        |---------------------------------------------------------------            
        | Warning need to do reserved words
        |---------------------------------------------------------------            
        */       
        $validator = Validator::make($request->all(), [
           'matrix_name' => [
              'required',
              'alpha:ascii',
              'unique:fields,name',
              Rule::notIn(['url', 'content', 'id', 'section', 'field',
                    'entryid', 'entrytitle']),
           ],
        ]);

        if ($validator->fails()) {
            echo ($validator->errors());
        } else {

           $items = $request->input('items');      
           $data = json_encode($items);

           Matrix::add_matrix($matrix_name, $data);

           echo json_encode('success');
        }

    }

    //ajax response
    public function add_matrix_block(Request $request)
    {
        $data = $request->input('items');

        $data2 = json_decode($data);

        $validation_matrix = [
            'title' => $data2->fieldname,
            'instructions' => $data2->instructions,
            'type' => $data2->type,
            'length' => $data2->length,
            'variations' => $data2->variations, //comma delimited string
        ];

        $matrixContent = $request->input('matrix');
        $this->m_val($matrixContent, $validation_matrix);
    }

    public function m_val($matrixContent, $validation_matrix)
    {
        //First one matrixContent should be null
        $arr = Matrix::get_fieldnames($matrixContent);
        /*
          |---------------------------------------------------------------
          | Now check fieldname doesn't conflict with existing array
          |---------------------------------------------------------------
           */
        $flag = Helper::not_in_array($validation_matrix['title'], $arr);

        if ($flag == false) {
            echo 'duplicate fieldname';
        } else {

            // Perform additional check for special fieldtypes
            // drop-down check-box file-upload
            if (($validation_matrix['type'] == 'drop-down')
                || ($validation_matrix['type'] == 'check-box')
                || ($validation_matrix['type'] == 'file-upload')) {
                $arr = Matrix::get_variations($validation_matrix['variations']);
                //$flag = Helper::no_duplicates($arr);
                $flag2 = Helper::is_valid_csv_string($validation_matrix['variations']);

                if ($flag === true && $flag2 === true) {
                    // echo 'success';
                } else {
                    echo 'The options MUST be unique! Or invalid csv string!';
                }
            }
            $this->f_val($validation_matrix);
        }
    }

    /*
    |---------------------------------------------------------------
    | Break it up for clarity
    |---------------------------------------------------------------
     */
    public function f_val($validation_matrix)
    {
        $validator = Validator::make($validation_matrix, [
            'title' => 'required|alpha::asci',
        ]);

        if ($validator->fails()) {
            echo $validator->errors();
        } else {
            echo 'success';
        }

    }

    /*
    |---------------------------------------------------------------
    | Note for deleting we are just using fields delete
    |
    | Consider matrix editing for later date as logic
    | is quite complicated.
    |---------------------------------------------------------------
    */
}

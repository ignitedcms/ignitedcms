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

use Ignitedcms\Ignitedcms\Http\Middleware\Igs_auth;
use Ignitedcms\Ignitedcms\Models\admin\Fields;
use Ignitedcms\Ignitedcms\Models\admin\Matrix;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

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
        echo 'creating matrix';
    }

    //ajax response
    public function add_matrix_block(Request $request)
    {
        $data = $request->input('items');
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

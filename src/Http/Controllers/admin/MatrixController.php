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
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class MatrixController extends Controller
{
    public function __construct()
    {
        $this->middleware(Igs_auth::class.':13');
    }

    public function createView()
    {
        $data = 'Matrix';

        return view('ignitedcms::admin.matrix.create')->with([
            'data' => $data,
        ]);
    }

    public function create(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'matrix_name' => [
                'required',
                'alpha:ascii',
                'unique:fields,name',
                Rule::notIn([
                    'url',
                    'content',
                    'id',
                    'section',
                    'field',
                    'entryid',
                    'entrytitle',
                ]),
            ],
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors());
        }

        $matrix_name = $request->input('matrix_name');

        if (Matrix::doesNameConflictWithGlobal($matrix_name)) {
            return response()->json('Name conflict');
        }

        $items = $request->input('items');
        $data = json_encode($items); //json string

        if (str_contains($data, '[]')) {

            return response()->json('No content');
        }

        Matrix::addMatrix($matrix_name, $data);

        return response()->json('success');

    }

    //for frontend
    public function addMatrixBlock2(Request $request)
    {
        $fieldid = $request->input('idx');

        $query = DB::table('fields')
            ->select('*')
            ->where('id', '=', $fieldid)
            ->get();

        echo $query[0]->opts;
    }

    //ajax response
    public function addMatrixBlock(Request $request)
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
        $this->validateMatrix($matrixContent, $validation_matrix);
    }

    public function validateMatrix($matrixContent, $validationMatrix)
    {
        $fieldNames = Matrix::getFieldnames($matrixContent);

        $isFieldUnique = Helper::notInArray($validationMatrix['title'], $fieldNames);

        if (! $isFieldUnique) {
            echo json_encode(['a' => 'Duplicate field name']);
        } else {
            $matrixType = $validationMatrix['type'];

            // Perform additional checks for special field types: drop-down, check-box, file-upload
            if (in_array($matrixType, ['drop-down', 'check-box', 'file-upload'])) {
                $variations = $validationMatrix['variations'];
                $variationsArray = Matrix::getVariations($variations);

                $hasNoDuplicates = Helper::noDuplicates($variationsArray);
                $isValidCsv = Helper::isValidCsvString($variations);

                if ($hasNoDuplicates && $isValidCsv) {
                    // Success case, do something
                } else {
                    echo json_encode(['b' => 'Options must be unique or a invalid CSV string']);
                    exit(); // Bail out
                }
            }

            $this->fVal($validationMatrix);
        }
    }

    /*
    |---------------------------------------------------------------
    | Break it up for clarity
    |---------------------------------------------------------------
     */
    public function fVal($validation_matrix)
    {
        $validator = Validator::make($validation_matrix, [
            'title' => [
                'required',
                'alpha:ascii',
                Rule::notIn(['url', 'content', 'id', 'section', 'field',
                    'entryid', 'entrytitle']),
            ],
        ]);

        if ($validator->fails()) {
            echo json_encode(['a' => $validator->errors()]);
        } else {
            echo json_encode(['a' => 'success']);
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

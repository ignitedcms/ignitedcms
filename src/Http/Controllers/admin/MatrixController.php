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
use Illuminate\Validation\Rule;



class MatrixController extends Controller
{
   public function __construct() 
   {
      $this->middleware(Igs_auth::class.':13');
   }

   public function create_view()
   {
      $data = 'foo';
      return view('ignitedcms::admin.matrix.create')->with([
            'data' => $data,
        ]);
   }
}

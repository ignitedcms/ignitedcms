<?php
/*
|---------------------------------------------------------------
| Database controller
|---------------------------------------------------------------
|
| Dumps MySQL db
|
|
| @author: IgnitedCMS
| @license: MIT
| @version: 1.0
| @since: 1.0
*/

namespace Ignitedcms\Ignitedcms\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Ignitedcms\Ignitedcms\Http\Middleware\Igs_auth;

use Ignitedcms\Ignitedcms\Models\admin\Database;

class DatabaseController extends Controller
{
   public function __construct() 
   {
      $this->middleware(Igs_auth::class);
   }

    public function index()
    {
        $data = '';

        return view('ignitedcms::admin.database.index')->with([
            'data' => $data,
        ]);
    }

    public static function backup()
    {
        Database::backup();
    }
}

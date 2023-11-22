<?php
/*
|---------------------------------------------------------------
| Permissions controller
|---------------------------------------------------------------
|
| @author: IgnitedCMS
| @license: MIT
| @version: 1.0
| @since: 1.0
*/

namespace Ignitedcms\Ignitedcms\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Ignitedcms\Ignitedcms\Http\Middleware\Igs_auth;

class PermissionController extends Controller
{
    public function __construct()
    {
        $this->middleware(Igs_auth::class);
    }

    //load the default user view
    public function index()
    {
        $data = '';

        return view('ignitedcms::admin.permissions.index')->with([
            'data' => $data,
        ]);
    }

    public function create_view()
    {
        $data = '';

        return view('ignitedcms::admin.permissions.create')->with([
            'data' => $data,
        ]);

    }
}

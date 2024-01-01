<?php
/*
|---------------------------------------------------------------
| Email controller
|---------------------------------------------------------------
|
| Manual setup where user needs to refer to Laravel docs
|
|
| @author: IgnitedCMS
| @license: MIT
| @version: 1.0
| @since: 1.0
*/

namespace Ignitedcms\Ignitedcms\Http\Controllers\admin;

use Ignitedcms\Ignitedcms\Http\Middleware\Igs_auth;
use Illuminate\Routing\Controller;

class EmailController extends Controller
{
    public function __construct()
    {
        $this->middleware(Igs_auth::class.':3');
    }

    public function index()
    {
        $data = '';

        return view('ignitedcms::admin.email.index')->with([
            'data' => $data,
        ]);
    }
}

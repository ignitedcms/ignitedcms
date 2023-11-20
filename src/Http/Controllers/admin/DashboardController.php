<?php
/*
|---------------------------------------------------------------
| Dashboard controller
|---------------------------------------------------------------
|
| All logic for the dashboard
|
|
| @author: IgnitedCMS
| @license: MIT
| @version: 1.0
| @since: 1.0
*/

namespace Ignitedcms\Ignitedcms\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Http\Middleware\Igs_auth;

class DashboardController extends Controller
{
    public function __construct()
    {
        // $this->middleware(Igs_auth::class);
    }

    public function index()
    {
        return view('ignitedcms::admin.dashboard.index');
    }
}

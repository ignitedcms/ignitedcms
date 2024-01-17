<?php
/*
|---------------------------------------------------------------
| Email controller
|---------------------------------------------------------------
|
| Manual setup where user needs to refer to Laravel docs
| to set the variables from the .env file
|
|
| @author: IgnitedCMS
| @license: MIT
| @version: 1.0
| @since: 1.0
*/

namespace Ignitedcms\Ignitedcms\Http\Controllers\admin;

use Ignitedcms\Ignitedcms\Http\Middleware\Igs_auth;
use Ignitedcms\Ignitedcms\Mail\WelcomeMail;
use Illuminate\Http\Request;
//For emailing
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Mail;

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

    public function sendMail(Request $request)
    {
        $validated = $request->validate([
            'email' => 'required|email',
        ]);

        $email = $request->input('email');
        Mail::to($email)->send(new WelcomeMail());

        return redirect('admin/email')->with('status', 'Check your inbox');
    }
}

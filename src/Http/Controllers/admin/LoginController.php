<?php
/*
|---------------------------------------------------------------
| Logging in controller
|---------------------------------------------------------------
|
| All core utilites for logging into dashboard
|
| @author: IgnitedCMS
| @license: MIT
| @version: 1.0
| @since: 1.0
*/

namespace Ignitedcms\Ignitedcms\Http\Controllers\admin;

//use App\Http\Controllers\Controller;
use App\Models\admin\Login;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{
    public function index()
    {
        //Login::foo();

        return view('ignitedcms::admin.login.index');
    }

    public function logout(Request $request)
    {
        $request->session()->flush();

        return redirect('login');
    }

    /*
     * Validate login
     *
     *
     * @param   string $email POST
     * @param   string $password POST
     * @return  void
     */
    public function validateLogin(Request $request)
    {
        $validated = $request->validate([
            'email' => 'required|email|max:255',
            'password' => 'required|min:6',
        ]);
        // If passed

        $email = $request->input('email');
        $password = $request->input('password');

        // Authorize email and password then set session

        /*
        |---------------------------------------------------------------
        | Important note on validation
        |---------------------------------------------------------------
        |
        | We need to use withInput to repopulate form data
        | See laravel documentation
        |
        */

        $user = DB::table('user')->where('email', $email)->first();

        if ($user === null) {
            //set flash session error data
            return redirect('login')->with('status', 'Login details failed!')->withInput();
        } else {
            $hashedPassword = $user->password;
            if (Hash::check($password, $hashedPassword)) {
                //set logged in session and redirect to dashboard

                $userid = $user->id;

                //save logged_in and userid to session!!
                $request->session()->put('logged_in', '1');
                $request->session()->put('userid', $userid);

                return redirect('admin/dashboard');
            } else {
                //set flash session error data
                return redirect('login')->with('status', 'Login details failed!')->withInput();
            }
        }
    }
}

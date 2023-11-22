<?php
/*
|---------------------------------------------------------------
| Profile controller
|---------------------------------------------------------------
|
| User can update their profile, uses session, userid
| for authentication, when changing or saving.
|
| @author: IgnitedCMS
| @license: MIT
| @version: 1.0
| @since: 1.0
*/

namespace Ignitedcms\Ignitedcms\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Ignitedcms\Ignitedcms\Http\Middleware\Igs_auth;
use Ignitedcms\Ignitedcms\Models\admin\Profile;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function __construct()
    {
        $this->middleware(Igs_auth::class);
    }

    //load the view
    public function index()
    {

        $userid = session('userid');
        $data = Profile::first($userid);

        return view('ignitedcms::admin.profile.index')->with([
            'data' => $data,
        ]);
    }

    public function update(Request $request)
    {
        $userid = session('userid');

        $validated = $request->validate([
            'fullname' => 'required|max:255',
        ]);

        $fullname = $request->input('fullname');
        //Success
        Profile::update($userid, $fullname);

        return redirect('admin/profile')->with('status', 'Updated successfully');

    }
}

<?php
/*
|---------------------------------------------------------------
| User controller
|---------------------------------------------------------------
|
| For the creation of new users and setting their
| default permissions
|
| @author: IgnitedCMS
| @license: MIT
| @version: 1.0
| @since: 1.0
*/

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Http\Middleware\Igs_auth;
use App\Models\admin\Users;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware(Igs_auth::class);
    }

    //load the default user view
    public function index()
    {
        $data = Users::all();
        //dd($data);

        return view('admin.users.index')->with([
            'data' => $data,
        ]);
    }

    //need to pass in permission group
    public function create_view()
    {
        $data = Users::permission_groups();

        return view('admin.users.create')->with([
            'data' => $data,
        ]);
    }

    public function create(Request $request)
    {

        $validated = $request->validate([
            'email' => 'required|unique:user|max:255',
            'password' => 'required|min:6',
            'permissiongroup' => 'required',
        ]);

        $email = $request->input('email');
        $password = $request->input('password');
        $permissiongroup = $request->input('permissiongroup');

        Users::create_user($email, $password, $permissiongroup);

        return redirect('admin/users')->with('status', 'User created!');
    }

    public function update_view($id)
    {
        $data = Users::permission_groups();

        $email = Users::get_email($id);

        return view('admin.users.edit')->with([
            'data' => $data,
            'email' => $email,
            'id' => $id,
        ]);
    }

    /*
     * Update the selected users permission group
     *
     *
     * @param   int $userid POST
     * @return  void (updates permissions)
     */
    public function update(Request $request, $id)
    {
        $permissiongroup_id = $request->input('permissiongroup');

        Users::update_permissions($id, $permissiongroup_id);

        return redirect('admin/users')->with('status', 'Permissions updated!');

    }

    // Delete the user
    public function destroy($id)
    {
        Users::destroy($id);

        return redirect('admin/users');
    }
}

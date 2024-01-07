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

namespace Ignitedcms\Ignitedcms\Http\Controllers\admin;

//use App\Http\Controllers\Controller;
use Ignitedcms\Ignitedcms\Http\Middleware\Igs_auth;
use Ignitedcms\Ignitedcms\Models\admin\Users;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware(Igs_auth::class.':9');
    }

    //load the default user view
    public function index()
    {
        $data = Users::all();
        //dd($data);

        return view('ignitedcms::admin.users.index')->with([
            'data' => $data,
        ]);
    }

    //need to pass in permission group
    public function createView()
    {
        $data = Users::permissionGroups();

        return view('ignitedcms::admin.users.create')->with([
            'data' => $data,
        ]);
    }

    public function create(Request $request)
    {

        $validated = $request->validate([
            'email' => 'required|email|unique:user|max:255',
            'password' => 'required|min:6',
            'permissiongroup' => 'required',
        ]);

        $email = $request->input('email');
        $password = $request->input('password');
        $permissiongroup = $request->input('permissiongroup');

        Users::createUser($email, $password, $permissiongroup);

        return redirect('admin/users')->with('status', 'User created!');
    }

    public function updateView($id)
    {
        $data = Users::permissionGroups();

        $email = Users::getEmail($id);

        $permissionGroupId = Users::usersPermissionGroup($id);


        return view('ignitedcms::admin.users.edit')->with([
            'data' => $data,
            'email' => $email,
            'id' => $id,
            'permissionid' => $permissionGroupId,
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
        //Check if admin disable update functionality

        if ($id == 1) {
            //do nothing
            return redirect('admin/users')->with('error', 'You cannot 
              update Adminstrator permissions!');
        } else {

            $permissiongroup_id = $request->input('permissiongroup');

            Users::updatePermissions($id, $permissiongroup_id);

            return redirect('admin/users')->with('status', 'Permissions 
               updated!');
        }
    }

    // Delete the user
    public function destroy($id)
    {
        if ($id == 1) {

            return redirect('admin/users')->with('error', 'You cannot 
             delete the main admin account!');
        } else {

            Users::destroy($id);

            return redirect('admin/users')->with('status', 'User deleted');
        }
    }
}

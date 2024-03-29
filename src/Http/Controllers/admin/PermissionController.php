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

//use App\Http\Controllers\Controller;
use Ignitedcms\Ignitedcms\Http\Middleware\Igs_auth;
use Ignitedcms\Ignitedcms\Models\Admin\Permissions;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class PermissionController extends Controller
{
    public function __construct()
    {
        $this->middleware(Igs_auth::class.':5');

    }

    //load the default user view
    public function index()
    {

        $data = Permissions::all();

        return view('ignitedcms::admin.permissions.index')->with([
            'data' => $data,
        ]);
    }

    public function createView()
    {

        $data = Permissions::getAllPermissions();

        return view('ignitedcms::admin.permissions.create')->with([
            'data' => $data,
        ]);
    }

    /*
     * Save new permission group
     *
     *
     * @param   string $grouName as POST
     * @param   array $permission ids
     * @return  void
     */
    public function create(Request $request)
    {

        $validated = $request->validate([
            'groupName' => 'required|unique:permission_groups|max:255|alpha:ascii',
            'boxes' => 'required',
        ]);

        $groupName = $request->input('groupName');
        $arr = $request->input('boxes');

        Permissions::createGroup($groupName, $arr);

        return redirect('admin/permissions')->with('status', 'New group saved');
    }

    public function updateView($id)
    {

        $data = Permissions::getAllPermissions();
        $id = $id;
        $groupName = Permissions::getGroupName($id);

        $map = Permissions::getPermissionsByGroupid($id);

        return view('ignitedcms::admin.permissions.edit')->with([
            'data' => $data,
            'id' => $id,
            'groupName' => $groupName,
            'map' => $map,
        ]);

    }

    public function update(Request $request, $id)
    {
        //If the permission group is administrators they
        // shouldn't be able to update their permissions
        // as by default, they should have access to everything!

        if ($id == 1) {

            return redirect('admin/permissions')->with('error',
                'You cannot update Administrator permissions!');

        } else {
            //First let's clear the permission_map for the groupID
            //then insert the POST vars

            $validated = $request->validate([
                'boxes' => 'required',
            ]);
            $map = $request->input('boxes');

            Permissions::updatePermissions($id, $map);

            return redirect('admin/permissions')->with('status',
                'Updated successfully');

        }
    }

    public function destroy(Request $request, $id)
    {
        $message = '';
        //Admin disable delete
        if ($id == 1) {
            $message = 'You cannot delete Administrators!';

            return redirect('admin/permissions')->with('error', $message);
        } else {

            //Check that no user has this permissions assigned

            if (Permissions::checkIfPermissionidIsUsed($id)) {
                $message = 'This permission group is in use by a user';

                return redirect('admin/permissions')->with('error', $message);

            } else {

                Permissions::destroy($id);

                return redirect('admin/permissions')->with('status', 'Permission removed successfully');
            }
        }
    }
}

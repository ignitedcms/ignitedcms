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
use Ignitedcms\Ignitedcms\Models\Admin\Permissions;
use Illuminate\Http\Request;

class PermissionController extends Controller
{
    public function __construct()
    {
        $this->middleware(Igs_auth::class);
    }

    //load the default user view
    public function index()
    {

        $data = Permissions::all();

        return view('ignitedcms::admin.permissions.index')->with([
            'data' => $data,
        ]);
    }

    public function create_view()
    {

        $data = Permissions::get_all_permissions();

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
        ]);

        $groupName = $request->input('groupName');
        $arr = $request->input('boxes');

        Permissions::create_group($groupName, $arr);

        return redirect('admin/permissions')->with('status', 'New group saved');
    }
}

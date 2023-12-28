<?php

/*
|---------------------------------------------------------------
| Installer controller
|---------------------------------------------------------------
|
| Defines all the logic for installation, including loading
| the sql tables and validating the admin email and password
|
| @author: IgnitedCMS
| @license: MIT
| @version: 1.0
| @since: 1.0
*/

namespace Ignitedcms\Ignitedcms\Http\Controllers\admin;

//use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class InstallController extends Controller
{
    public function index()
    {
        $query = DB::table('user')
            ->select('*');
        if ($query->count() > 0) {
            echo "Looks like you've already ran the installer";
        }
        else {
            return view('ignitedcms::admin.installer.index');
        }

    }

    public function bar()
    {
        return redirect('installer/register');
    }

    public function one()
    {
        return view('ignitedcms::admin.installer.one');
    }

    public function two()
    {
        return view('ignitedcms::admin.installer.two');
    }

    public function validateForm(Request $request)
    {
        $validated = $request->validate([
            'email' => 'required|email|max:255',
            'password' => 'required|min:6',
        ]);
        // If passed
        DB::table('user')->insert([
            'email' => $request->email,
            'joindate' => date('Y-m-d'),
            'permissiongroup' => 1,
            'password' => Hash::make($request->password),
        ]);

        //Now the admin user has been added id=1
        //Create the necessary permissionGroup tables

        $prefix = '';

        $sql1 = 'INSERT INTO `'.$prefix."permissions` (`permissionID`, `permission`,`order_position`) VALUES
         (3, 'email',6),
         (5, 'permissions',8),
         (6, 'profile',1),
         (9,'users',9),
         (7,'menu',2),
         (10,'database',10),
         (13,'field_builder',13),
         (14,'sections',14),
         (15,'entries',15),
         (17,'asset_lib',17),
         (18,'site_settings',18),
         (19,'paypal',19),
         (20,'plugins',20),
         (21,'ipn',21);";

        $sql2 = 'INSERT INTO `'.$prefix.'permission_map`(`groupID`, `permissionID`) VALUES
         (1,3),
         (1,5),
         (1,6),
         (1,7),
         (1,9),
         (1,10),
         (1,13),
         (1,14),
         (1,15),
         (1,17),
         (1,18),
         (1,19),
         (1,20),
         (1,21);';

        $sql3 = 'INSERT INTO `'.$prefix."permission_groups`(`groupID`, `groupName`) VALUES
         (1,'Administrators');";

        DB::statement($sql1);
        DB::statement($sql2);
        DB::statement($sql3);

        return redirect('login')->with('final', 'Account successfully created');
    }
}

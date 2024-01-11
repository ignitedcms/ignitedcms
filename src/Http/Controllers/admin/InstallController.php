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
        } else {
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

        $sql1 = [
            ['permissionID' => 3, 'permission' => 'Email', 'order_position' => 6],
            ['permissionID' => 5, 'permission' => 'Permissions', 'order_position' => 8],
            ['permissionID' => 6, 'permission' => 'Profile', 'order_position' => 1],
            ['permissionID' => 9, 'permission' => 'Users', 'order_position' => 9],
            ['permissionID' => 7, 'permission' => 'Menu', 'order_position' => 2],
            ['permissionID' => 10, 'permission' => 'Database', 'order_position' => 10],
            ['permissionID' => 13, 'permission' => 'Fields', 'order_position' => 13],
            ['permissionID' => 14, 'permission' => 'Sections', 'order_position' => 14],
            ['permissionID' => 15, 'permission' => 'Entries', 'order_position' => 15],
            ['permissionID' => 17, 'permission' => 'Assets', 'order_position' => 17],
            ['permissionID' => 18, 'permission' => 'Site settings', 'order_position' => 18],
            ['permissionID' => 19, 'permission' => 'Paypal', 'order_position' => 19],
            ['permissionID' => 20, 'permission' => 'Plugins', 'order_position' => 20],
            ['permissionID' => 21, 'permission' => 'IPN', 'order_position' => 21],
        ];

        DB::table($prefix.'permissions')->insert($sql1);

        $sql2 = [
            ['groupID' => 1, 'permissionID' => 3],
            ['groupID' => 1, 'permissionID' => 5],
            ['groupID' => 1, 'permissionID' => 6],
            ['groupID' => 1, 'permissionID' => 7],
            ['groupID' => 1, 'permissionID' => 9],
            ['groupID' => 1, 'permissionID' => 10],
            ['groupID' => 1, 'permissionID' => 13],
            ['groupID' => 1, 'permissionID' => 14],
            ['groupID' => 1, 'permissionID' => 15],
            ['groupID' => 1, 'permissionID' => 17],
            ['groupID' => 1, 'permissionID' => 18],
            ['groupID' => 1, 'permissionID' => 19],
            ['groupID' => 1, 'permissionID' => 20],
            ['groupID' => 1, 'permissionID' => 21],
        ];

        DB::table($prefix.'permission_map')->insert($sql2);

        $sql3 = [
            ['groupID' => 1, 'groupName' => 'Administrators'],
        ];

        DB::table($prefix.'permission_groups')->insert($sql3);

        //Finally add the asset upload file allowed types
        $sql4 = [
            ['name' => 'Audio', 'extensions' => 'mp3,wav,ogg,acc,flac', 'enabled' => 0],
            ['name' => 'Zip', 'extensions' => 'zip,rar', 'enabled' => 0],
            ['name' => 'Microsoft', 'extensions' => 'doc,docx,xls,xlsx,ppt,pptx', 'enabled' => 0],
            ['name' => 'Image', 'extensions' => 'jpg,jpeg,bmp,png,svg,gif', 'enabled' => 1],
            ['name' => 'Javascript', 'extensions' => 'js', 'enabled' => 0],
            ['name' => 'PDF', 'extensions' => 'pdf', 'enabled' => 0],
            ['name' => 'Text', 'extensions' => 'txt', 'enabled' => 0],
            ['name' => 'Video', 'extensions' => 'avi,mp4,mpeg,quicktime,mov', 'enabled' => 0],
        ];

        DB::table($prefix.'site_settings')->insert($sql4);

        $sql5 = [
            ['id' => 1, 'name' => ''],
        ];

        DB::table($prefix.'url_settings')->insert($sql5);

        return redirect('login')->with('final', 'Account successfully created');
    }
}

<?php
/*
|---------------------------------------------------------------
| Settings controller
|---------------------------------------------------------------
|
| Where the administrator can set asset upload limitations
|
| @author: IgnitedCMS
| @license: MIT
| @version: 1.0
| @since: 1.0
*/

namespace Ignitedcms\Ignitedcms\Http\Controllers\admin;

//use App\Http\Controllers\Controller;
use Ignitedcms\Ignitedcms\Http\Middleware\Igs_auth;
use Ignitedcms\Ignitedcms\Models\admin\Settings;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class SettingsController extends Controller
{
    public function __construct()
    {
        $this->middleware(Igs_auth::class.':18');
    }

    //load the view
    public function index()
    {
        $data = Settings::all();

        //Let's get all sections
        $data2 = Settings::getSections();

        return view('ignitedcms::admin.settings.index')->with([
            'data' => $data,
            'data2' => $data2,
        ]);

    }

    public function update(Request $request)
    {
        $validated = $request->validate([
            'fileTypes' => 'required',
        ]);
        $map = $request->input('fileTypes');

        Settings::updateSettings($map);

        return redirect('admin/settings')->with('status', 'Allowed filetypes updated!');

    }
}

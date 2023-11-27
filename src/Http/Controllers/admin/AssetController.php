<?php
/*
|---------------------------------------------------------------
| Asset controller
|---------------------------------------------------------------
|
| All logic for uploading assets
| Need to look and gumlet for image resizing
|
|
| @author: IgnitedCMS
| @license: MIT
| @version: 1.0
| @since: 1.0
*/

namespace Ignitedcms\Ignitedcms\Http\Controllers\admin;

//use App\Http\Controllers\Controller;
use Gumlet\ImageResize;
use Ignitedcms\Ignitedcms\Http\Middleware\Igs_auth;
use Ignitedcms\Ignitedcms\Models\admin\Asset;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class AssetController extends Controller
{
    public function __construct()
    {
        $this->middleware(Igs_auth::class.':17');
    }

    public function index()
    {
        $data = Asset::all();

        return view('ignitedcms::admin.assets.index')->with([
            'data' => $data,
        ]);
    }

    public function create_view()
    {
        $data = 'assets';

        return view('ignitedcms::admin.assets.create')->with([
            'data' => $data,
        ]);
    }

    public function is_image($file)
    {
        $extension = $file->getClientOriginalExtension(); // Get the file extension
        if (in_array($extension, ['jpeg', 'jpg', 'png', 'gif', 'bmp'])) {
            return true;
        }
    }

    //Upload and save file into uploads
    public function create(Request $request)
    {
        //Hard coded for time bein
        $request->validate([
            'file' => 'required|file|mimes:jpeg,jpg,png,pdf,svg|max:2048', // Validation rules for the file
        ]);

        if ($request->hasFile('file')) {
            $file = $request->file('file');
            $fileName = time().'_'.$file->getClientOriginalName();
            $thumb = '';

            // Define the path where you want to store the file
            $path = public_path('uploads');

            // Move the file to the defined path
            $file->move($path, $fileName);

            //Let's attempt a image resize using gumlet

            if ($this->is_image($file)) {
                $image = new ImageResize($path.'/'.$fileName);
                $image->resizeToWidth(60);
                $thumb = 'thumb_'.time().'_'.$file->getClientOriginalName();
                $image->save(public_path("uploads/$thumb"));

                $thumb = url(asset("uploads/$thumb"));
            }

            //$filename = $file->getClientOriginalName();
            $kind = $file->getClientOriginalExtension();
            $url = url(asset("uploads/$fileName"));

            $fieldname = '';

            Asset::create(
                $fileName,
                $kind,
                $url,
                $thumb,
                $fieldname);

            return redirect('admin/assets')->with('status', 'Upload successful');
        }

        //error msg
    }

    public function update_view($id)
    {

        $data = Asset::update($id);

        return view('ignitedcms::admin.assets.edit')->with([
            'data' => $data,
        ]);
    }

    //Delete from the db and remove from uploads
    public function destroy(Request $request, $id)
    {
        Asset::destroy($id);

        return redirect('admin/assets')->with('status', 'File removed');
    }
}

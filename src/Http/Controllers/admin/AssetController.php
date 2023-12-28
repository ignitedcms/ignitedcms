<?php
/*
|---------------------------------------------------------------
| Asset controller
|---------------------------------------------------------------
|
| All logic for uploading assets
| Use  gumlet dependency for image resizing
| See composer json for information
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

    public function createView()
    {
        $data = 'assets';

        return view('ignitedcms::admin.assets.create')->with([
            'data' => $data,
        ]);
    }

    public function isImage($file)
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
            'file' => 'required|file|mimes:jpeg,jpg,png,pdf,svg|max:10048', // Validation rules for the file
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

            if ($this->isImage($file)) {
                $image = new ImageResize($path.'/'.$fileName);
                $image->resize(50, 50);
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

    public function updateView($id)
    {

        $data = Asset::update($id);
        $assetId = $id;

        return view('ignitedcms::admin.assets.edit')->with([
            'data' => $data,
            'assetId' => $assetId,
        ]);
    }

    /*
     * Update the alt_title field
     *
     *
     * @param   string $alt_tile POST request
     * @param   int $assetId
     * @return  void
     */
    public function update(Request $request, $assetId)
    {
        $validated = $request->validate([
            'alt_title' => 'required',
        ]);
        //If pass then let's update the db
        Asset::updateAltTitle($assetId, $request->alt_title);

        return redirect('admin/assets')->with('status', 'Alt title updated');
    }

    //Delete from the db and remove from uploads
    public function destroy(Request $request, $id)
    {
        Asset::destroy($id);

        return redirect('admin/assets')->with('status', 'File removed');
    }
}

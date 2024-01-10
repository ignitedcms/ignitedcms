<?php
/*
|---------------------------------------------------------------
| Chunked File controller
|---------------------------------------------------------------
|
| Uploader for only files > 10mb!
| Depends on Plupload
| 
| 
|
|
| @author: IgnitedCMS
| @license: MIT
| @version: 1.0
| @since: 1.0
*/

namespace Ignitedcms\Ignitedcms\Http\Controllers\admin;

//use App\Http\Controllers\Controller;
use Ignitedcms\Ignitedcms\Http\Middleware\Igs_auth;
use Ignitedcms\Ignitedcms\Models\admin\Asset;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class ChunkFileController extends Controller
{
    public function __construct()
    {
        $this->middleware(Igs_auth::class.':17');
    }
   
    public function index()
    {
       return view('ignitedcms::admin.chunks.index');
    }

     /**
     * Write code on Method
     *
     * @return response()
     */
    public function chunkStore(Request $request)
    {
        $_REQUEST['name'];
        $input = $request->all();

        // THE UPLOAD DESTINATION - CHANGE THIS TO YOUR OWN

        $filePath = 'uploads';

        if (! file_exists($filePath)) {
            if (! mkdir($filePath, 0777, true)) {
                return response()->json(['ok' => 0, 'info' => "Failed to create $filePath"]);
            }
        }

        $fileName = isset($_REQUEST['name']) ? $_REQUEST['name'] : $_FILES['file']['name'];
        $filePath = $filePath.DIRECTORY_SEPARATOR.$fileName;

        // DEAL WITH CHUNKS

        $chunk = isset($_REQUEST['chunk']) ? intval($_REQUEST['chunk']) : 0;
        $chunks = isset($_REQUEST['chunks']) ? intval($_REQUEST['chunks']) : 0;
        $out = fopen("{$filePath}.part", $chunk == 0 ? 'wb' : 'ab');

        if ($out) {
            $in = fopen($_FILES['file']['tmp_name'], 'rb');

            if ($in) {
                while ($buff = fread($in, 4096)) {
                    fwrite($out, $buff);
                }
            } else {
                return response()->json(['ok' => 0, 'info' => 'Failed to open input stream']);
            }

            fclose($in);
            fclose($out);
            unlink($_FILES['file']['tmp_name']);
        }

        // CHECK IF THE FILE HAS BEEN UPLOADED

        if (! $chunks || $chunk == $chunks - 1) {
            rename("{$filePath}.part", $filePath);
            $array = ['file' => $fileName];
            //ChunkFile::create($array);
        }

        $info = 'Upload OK';
        $ok = 1;

        return response()->json(['ok' => $ok, 'info' => $info]);
    }

}


<?php
/*
|---------------------------------------------------------------
| Asset model
|---------------------------------------------------------------
|
|
| @author: IgnitedCMS
| @license: MIT
| @version: 1.0
| @since: 1.0
*/

namespace Ignitedcms\Ignitedcms\Models\admin;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;

class Asset
{
    public static function all()
    {
        return DB::table('assetfields')->get();
    }

    //Go ahead and insert the upload info
    //into our database
    public static function create(
        $folder,
        $large_file,
        $filename,
        $kind,
        $url,
        $thumb,
        $fieldname
    ) {
        $user_id = session('userid');
        $insertid = DB::table('assetfields')->insertGetId([
            'user_id' => $user_id,
            'folder' => $folder,
            'large_file' => $large_file,
            'filename' => $filename,
            'kind' => $kind,
            'url' => $url,
            'thumb' => $thumb,
            'fieldname' => $fieldname,
        ]);
    }

    public static function update($id)
    {
        return DB::table('assetfields')
            ->select('*')
            ->where('id', '=', $id)
            ->limit(1)
            ->get();
    }

    public static function updateAltTitle($id, $altTitle)
    {
        DB::table('assetfields')
            ->where('id', '=', $id)
            ->update([
                'alt_title' => $altTitle,
            ]);
    }

    public static function destroy($id)
    {
        //First remove from uploads
        // Specify the file path at the root level

        $rows = DB::table('assetfields')
            ->select('*')
            ->where('id', '=', $id)
            ->limit(1)
            ->get();

        $filename = $rows[0]->filename;
        $folder = $rows[0]->folder;
        $large_file = $rows[0]->large_file;

        $filePath = public_path("uploads/$filename");


        //Delete large files including folder

        if($large_file)
        {
           $directoryPath = public_path("uploads/$folder");

           File::deleteDirectory($directoryPath, true);
           File::deleteDirectory($directoryPath);
        }


        // Check if the file exists
        if (File::exists($filePath)) {

            File::delete($filePath);

        } else {
            //return some error
        }

        //Now delete entry from db

        DB::table('assetfields')
            ->where('id', '=', $id)
            ->delete();

    }
}

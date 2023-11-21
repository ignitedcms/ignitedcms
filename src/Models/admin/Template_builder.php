<?php
/*
|---------------------------------------------------------------
| Template builder model
|---------------------------------------------------------------
|
| Attempts to automatically generate single or
| multiple templates in the resources >  views > custom directory
|
| WARNING write could cause potential security risks!!
|
| @author: IgnitedCMS
| @license: MIT
| @version: 1.0
| @since: 1.0
*/

namespace Ignitedcms\Ignitedcms\Models\admin;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

class Template_builder
{
    /*
     * Builds the template for singles
     * and dumps all the fields into it
     *
     *
     *
     * @param   int $sectionid
     * @param   int $entryid
     * @return  void Writes files to views directory
     */
    public static function build_single($sectionid, $entryid)
    {
        $custom_path = base_path("resources/views/custom");
        if (! File::exists($custom_path)) {

            // Create the directory
            File::makeDirectory($custom_path, 0755, true);
        }

        $sectionname = self::get_section_name($sectionid);
        $filePath = base_path("resources/views/custom/$sectionname.blade.php");

        $content = "@extends('custom.layout')\n";
        $content .= "@section('content')";
        $content .= self::get_field_handles($sectionid);
        $content .= '@endsection';
        // Write content to the file
        File::put($filePath, $content);
    }

    public static function read_stub($sectionname)
    {
        $filePath = base_path('public/stubs/multiple.stub');
        $fileContent = File::get($filePath);

        // Perform the string replacement
        $modifiedContent = Str::replace('%sectionname%', $sectionname, $fileContent);

        return $modifiedContent;

    }

    /*
     * Builds template for root and entry multiples
     *
     *
     * @param   int $sectionid
     * @return  void Writes to views directory
     */
    public static function build_multiple($sectionid)
    {

      $custom_path = base_path("resources/views/custom");
        if (! File::exists($custom_path)) {

            // Create the directory
            File::makeDirectory($custom_path, 0755, true);
        }

        // Specify the directory path at the root level

        $sectionname = self::get_section_name($sectionid);
        $directoryPath = base_path("resources/views/custom/$sectionname");

        if (! File::exists($directoryPath)) {

            // Create the directory
            File::makeDirectory($directoryPath, 0755, true);
        }

        //Finally add index.blade.php and _entry.blade.php inside folder

        $filePath = base_path("resources/views/custom/$sectionname/index.blade.php");

        // Write content to the file

        $stubContent = self::read_stub($sectionname);

        File::put($filePath, $stubContent);

        $filePath2 = base_path("resources/views/custom/$sectionname/_entry.blade.php");

        $content = "@extends('custom.layout')\n";
        $content .= "@section('content')";
        $content .= self::get_field_handles($sectionid);
        $content .= '@endsection';

        // Write content to the file
        File::put($filePath2, $content);
    }

    public static function remove_single($sectionname)
    {
        $filePath = base_path("resources/views/custom/$sectionname.blade.php");

        // Check if the file exists
        if (File::exists($filePath)) {
            // Delete the file
            File::delete($filePath);

            return response()->json(['message' => 'File deleted successfully']);
        } else {
            return response()->json(['message' => 'File not found'], 404);
        }
    }

    //remove directory and contents
    public static function remove_multiple($sectionname)
    {
        // Specify the directory path at the root level
        $directoryPath = base_path("resources/views/custom/$sectionname");

        //Warning use with care!
        // Recursively delete the directory and its contents
        File::deleteDirectory($directoryPath, true);

        File::deleteDirectory($directoryPath);

    }

    /**
     *  @Description: get all the field handles for sectionid
     *
     *       @Params: sectionid
     *
     *       @returns: string of all field handles eg {{entry.fieldHandle}} ...
     */
    public static function get_field_handles($sectionid)
    {
        //special case for assets,checkboxes and grid to do!!!

        $query = DB::table('section_layout')
            ->select('*')
            ->join('fields', 'section_layout.fieldid', '=', 'fields.id')
            ->where('section_layout.sectionid', '=', $sectionid)
            ->get();

        $string = "\n\t\t";
        foreach ($query as $row) {
            $string = $string.'{{ $'.$row->name.' }}'."\n\t\t";
        }

        return $string;
    }

    public static function get_section_name($sectionid)
    {
        $data = DB::table('section')
            ->where('id', '=', $sectionid)
            ->select('name')
            ->limit(1)
            ->get();

        return $data[0]->name;
    }
}

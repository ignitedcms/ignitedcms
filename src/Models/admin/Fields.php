<?php
/*
|---------------------------------------------------------------
| Field model
|---------------------------------------------------------------
|
|
| @author: IgnitedCMS
| @license: MIT
| @version: 1.0
| @since: 1.0
*/


namespace Ignitedcms\Ignitedcms\Models\admin;

use Illuminate\Database\Schema\Blueprint;
// For dynamically adding columns
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class Fields
{
    //use HasFactory;

    public static function all()
    {
        return DB::table('fields')->get();
    }

    public static function create(
        $name,
        $instructions,
        $type,
        $length,
        $variations,
        $form_validation
    ) {
        DB::table('fields')->insert([
            'name' => $name,
            'instructions' => $instructions,
            'type' => $type,
            'limitamount' => $length,
            'opts' => $variations,
            'formvalidation' => $form_validation,
        ]);

        /*
        |---------------------------------------------------------------
        | Now let's add a column for this in the content table
        | We need to pass this variable in as an anonymous fun
        |---------------------------------------------------------------
        */
        Schema::table('content', function (Blueprint $table) use ($name) {
            $table->string($name)->nullable();
        });
    }

    //public static function read($id)
    //{
    //return DB::table('fields')
    //->where('id', '=', $id)
    //->limit(1)
    //->get();
    //}

    public static function update($id)
    {
        return DB::table('fields')
            ->where('id', '=', $id)
            ->limit(1)
            ->get();
    }

    public static function destroy($id)
    {
        //Get the name before we delete it

        $data = DB::table('fields')
            ->where('id', '=', $id)
            ->limit(1)
            ->get('name');

        $name = $data[0]->name;

        //$name = 'prods';

        /*
         |---------------------------------------------------------------
         | Now let's drop this column
         |---------------------------------------------------------------
         */
        Schema::table('content', function (Blueprint $table) use ($name) {
            $table->dropColumn($name);
        });

        DB::table('fields')
            ->where('id', '=', $id)
            ->delete();

    }
}

<?php
/*
|---------------------------------------------------------------
| Matrix model
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
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;


class Matrix
{
    public static function test()
    {
        echo 'iamfrom the matrix';
    }

    /**
	 *  @Description: Add new matrix fields to database
	 *       @Params: $matrix_name, json
	 *
	 *    @returns: nothing
	 */
	public static function add_matrix($matrix_name, $data)
	{

		//NEED to use JSON.stringify and json_decode for quotes bug on
		//true and false values

      DB::table('fields')->insertGetId([
         'name' => $matrix_name,
			'type' => 'matrix',
			'opts' => json_decode($data),
			'instructions' => 'instructions',
			'maxchars' => '',
			'formvalidation' => 'min_length[1]', //WARNING
      ]);

        /*
        |---------------------------------------------------------------
        | Now let's add a column for this in the content table
        | We need to pass this variable in as an anonymous fun
        |---------------------------------------------------------------
        */
        Schema::table('content', function (Blueprint $table) use ($matrix_name) {
            $table->text($matrix_name)->nullable();
        });

	}
}

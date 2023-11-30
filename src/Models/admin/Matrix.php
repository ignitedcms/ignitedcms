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
		$this->load->dbforge();
		$fields = array(

			$matrix_name => array(
				'type' => 'TEXT',
				'null' => true,
			),
		);

		//NEED to use JSON.stringify and json_decode for quotes bug on
		//true and false values
		$object = array(
			'name' => $matrix_name,
			'type' => 'matrix',
			'opts' => json_decode($data),
			'instructions' => 'instructions',
			'maxchars' => '',
			'formvalidation' => 'min_length[1]',
		);

		$this->db->insert('fields', $object);
		$this->dbforge->add_column('content', $fields);
	}
}

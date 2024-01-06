<?php

namespace Ignitedcms\Ignitedcms\Tests;

use Illuminate\Foundation\Testing\RefreshDatabase;

class MatrixTest extends TestCase
{
    use RefreshDatabase;

    public function test_matrix_page()
    {
        //$this->withoutExceptionHandling();

        $response = $this->withSession(['logged_in' => 1, 'userid' => '1'])
            ->get('admin/matrix/create');

        $response->assertSee('The matrix is');
    }
}

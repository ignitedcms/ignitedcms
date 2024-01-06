<?php

namespace Ignitedcms\Ignitedcms\Tests;

use Illuminate\Foundation\Testing\RefreshDatabase;

class FieldsTest extends TestCase
{
    use RefreshDatabase;

    public function test_fields_page()
    {
        //$this->withoutExceptionHandling();

        $response = $this->withSession(['logged_in' => 1, 'userid' => '1'])
            ->get('admin/fields');

        $response->assertSee('Fields');
    }
}

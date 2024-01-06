<?php

namespace Ignitedcms\Ignitedcms\Tests;

use Illuminate\Foundation\Testing\RefreshDatabase;

class SectionsTest extends TestCase
{
    use RefreshDatabase;

    public function test_sections_page()
    {
        //$this->withoutExceptionHandling();

        $response = $this->withSession(['logged_in' => 1, 'userid' => '1'])
            ->get('admin/section');

        $response->assertSee('Sections');
    }
}

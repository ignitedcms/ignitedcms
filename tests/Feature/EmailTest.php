<?php

namespace Ignitedcms\Ignitedcms\Tests;

use Illuminate\Foundation\Testing\RefreshDatabase;

class EmailTest extends TestCase
{
    use RefreshDatabase;

    public function test_email_page()
    {
        //$this->withoutExceptionHandling();

        $response = $this->withSession(['logged_in' => 1, 'userid' => '1'])
            ->get('admin/email');

        $response->assertSee('Test if your email');
    }
}

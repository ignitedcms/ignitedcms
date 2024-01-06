<?php

namespace Ignitedcms\Ignitedcms\Tests;

use Illuminate\Foundation\Testing\RefreshDatabase;

class EntryTest extends TestCase
{
    use RefreshDatabase;

    public function test_entry_page()
    {
        //$this->withoutExceptionHandling();

        $response = $this->withSession(['logged_in' => 1, 'userid' => '1'])
            ->get('admin/entry');

        $response->assertSee('Entries');
    }
}

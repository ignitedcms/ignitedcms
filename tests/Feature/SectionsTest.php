<?php

namespace Ignitedcms\Ignitedcms\Tests;

use Ignitedcms\Ignitedcms\Models\admin\Section;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\DB;

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

    public function test_home_section()
    {
        //first create a field

        $insertid = DB::table('fields')->insertGetId([
            'name' => 'foo',
            'type' => 'plain-text',
        ]);

        $this->assertDatabaseHas('fields', [
            'name' => 'foo',
        ]);

        Section::create('home', 'single', '1');

        $this->assertDatabaseHas('section', [
            'name' => 'home',
        ]);

    }
}

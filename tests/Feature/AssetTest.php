<?php

namespace Ignitedcms\Ignitedcms\Tests;

use Illuminate\Foundation\Testing\RefreshDatabase;

class AssetTest extends TestCase
{
    use RefreshDatabase;

    public function test_assetpage()
    {
        //$this->withoutExceptionHandling();

        $response = $this->withSession(['logged_in' => 1, 'userid' => '1'])
            ->get('admin/assets');

        $response->assertSee('Upload all your media here');

    }
}

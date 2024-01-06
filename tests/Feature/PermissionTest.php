<?php

namespace Ignitedcms\Ignitedcms\Tests;

use Illuminate\Foundation\Testing\RefreshDatabase;

class PermissionTest extends TestCase
{
    use RefreshDatabase;

    public function test_permissions_dashboard()
    {
        //$this->withoutExceptionHandling();

        $response = $this->withSession(['logged_in' => 1, 'userid' => '1'])
            ->get('admin/permissions');

        $response->assertSee('Permissions');
    }

    public function test_cannot_delete_admin_permission()
    {
        $response = $this->withSession(['logged_in' => 1, 'userid' => '1'])
            ->post('admin/permissions/delete/1');

        $this->assertDatabaseHas('permission_groups', [
            'groupName' => 'Administrators',
        ]);

    }
}

<?php

namespace Ignitedcms\Ignitedcms\Tests;

use Illuminate\Foundation\Testing\RefreshDatabase;

class ProfileTest extends TestCase
{
    use RefreshDatabase;

    public function test_profile_page()
    {
        //$this->withoutExceptionHandling();

        $response = $this->withSession(['logged_in' => 1, 'userid' => '1'])
            ->get('admin/profile');

        $response->assertSee('Profile');

    }

    public function test_profile_update_fullname()
    {
        $response = $this->withSession(['logged_in' => 1, 'userid' => '1'])
            ->post('admin/profile/update', [
                'fullname' => 'john doe',
            ]);

        //$response->assertRedirect('admin/users');

        $this->assertDatabaseHas('user', [
            'fullname' => 'john doe',
        ]);

    }

    public function test_profile_update_no_password()
    {

        $response = $this->withSession(['logged_in' => 1, 'userid' => '1'])
            ->post('admin/profile/password', [
                'password' => '',
            ]);

        $response->assertSessionHasErrors('password');

    }
}

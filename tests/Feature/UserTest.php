<?php

namespace Ignitedcms\Ignitedcms\Tests;

class UserTest extends TestCase
{
    public function test_create_user()
    {
        //$this->withoutExceptionHandling();

        $response = $this->withSession(['logged_in' => 1, 'userid' => '1'])
            ->post('admin/users/create', [
                'email' => 'bob@mail.com',
                'password' => 'foo00000000000',
                'permissiongroup' => '1',
            ]);

        //$response->assertRedirect('admin/users');

        $this->assertDatabaseHas('user', [
            'email' => 'bob@mail.com',
        ]);
    }

    public function test_no_duplicate_user()
    {
        $response = $this->withSession(['logged_in' => 1, 'userid' => '1'])
            ->post('admin/users/create', [
                'email' => 'foo@mail.com',
                'password' => 'testfdsfds',
                'permissiongroup' => '1',
            ]);

        $response->assertSessionHasErrors('email');

    }

    public function test_create_user_no_password()
    {
        $response = $this->withSession(['logged_in' => 1, 'userid' => '1'])
            ->post('admin/users/create', [
                'email' => 'foo@mail.com',
                'password' => '',
                'permissiongroup' => '1',
            ]);

        $response->assertSessionHasErrors('password');
    }

    public function test_create_user_weak_password()
    {
        $response = $this->withSession(['logged_in' => 1, 'userid' => '1'])
            ->post('admin/users/create', [
                'email' => 'foo@mail.com',
                'password' => 'test',
                'permissiongroup' => '1',
            ]);

        $response->assertSessionHasErrors('password');
    }

    public function test_cannot_delete_admin()
    {
        $response = $this->withSession(['logged_in' => 1, 'userid' => '1'])
            ->post('admin/users/delete/1');

        $this->assertDatabaseHas('user', [
            'email' => 'foo@mail.com',
        ]);
    }
}

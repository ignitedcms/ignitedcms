<?php

namespace Ignitedcms\Ignitedcms\Tests;

use Illuminate\Support\Facades\Route;

class LoginTest extends TestCase
{
    public function test_example_route()
    {
        $this->get('/installer')->assertStatus(200);
    }

    public function test_user_login_good()
    {
        $response = $this->post('login/validate_login', [
            'email' => 'foo@mail.com',
            'password' => 'Letmein1',
        ])
            ->assertRedirect('admin/dashboard');

    }

    public function test_user_login_bad()
    {
        $response = $this->post('login/validate_login', [
            'email' => 'foo@mail.com',
            'password' => 'Letmein1xxx',
        ])
            ->assertRedirect('login');

    }

}


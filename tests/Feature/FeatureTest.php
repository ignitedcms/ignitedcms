<?php

namespace Ignitedcms\Ignitedcms\Tests;

//use Orchestra\Testbench\TestCase;
use Illuminate\Support\Facades\Route;

class FeatureTest extends TestCase
{
    /** @test */
    public function test_example_route()
    {
        //$response = $this->get('/installer'); // Replace with your route URL

        //$response->assertStatus(200); // Assert the response status code

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

    public function test_dashboard_with_session()
    {
        $response = $this->withSession(['logged_in' => 1])->get('admin/dashboard')->assertStatus(200);
    }

    public function test_dashboard_without_session()
    {
        //302 = redirect (to login)
        $response = $this->withSession(['logged_in' => ''])->get('admin/dashboard')->assertStatus(302);
    }

    public function test_create_user()
    {
     //$this->withoutExceptionHandling();

      $response = $this->withSession(['logged_in'=>1, 'userid'=>'1'])->post('admin/users/create',[
          'email'=>'bob@mail.com',
          'password'=>'foo00000000000',
          'permissiongroup'=>'1',
       ]);

       //$response->assertRedirect('admin/users');

      $this->assertDatabaseHas('user',[
         'email'=>'bob@mail.com'
      ]);
    }

}

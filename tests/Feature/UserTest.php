<?php

namespace Ignitedcms\Ignitedcms\Tests;

use Illuminate\Support\Facades\Route;

class UserTest extends TestCase
{

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


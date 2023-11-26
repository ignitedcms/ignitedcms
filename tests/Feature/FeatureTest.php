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
}

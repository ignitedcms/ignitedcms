<?php 

namespace Ignitedcms\Ignitedcms\Tests;

use Orchestra\Testbench\TestCase;

class FeatureTest extends TestCase
{

    /** @test */
    public function test_example_route()
    {
        $response = $this->get('/'); // Replace with your route URL

        $response->assertStatus(200); // Assert the response status code
        // Add more assertions to test the response content, headers, etc.
    }
}
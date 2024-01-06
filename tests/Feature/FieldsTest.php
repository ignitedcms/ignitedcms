<?php

namespace Ignitedcms\Ignitedcms\Tests;

use Illuminate\Foundation\Testing\RefreshDatabase;

class FieldsTest extends TestCase
{
    use RefreshDatabase;

    public function test_fields_page()
    {
        //$this->withoutExceptionHandling();

        $response = $this->withSession(['logged_in' => 1, 'userid' => '1'])
            ->get('admin/fields');

        $response->assertSee('Fields');
    }

    public function test_insert_field()
    {
        $response = $this->withSession([
            'logged_in' => 1,
            'userid' => '1',
        ])
            ->post('admin/fields/create', [
                'name' => 'foo',
                'instructions' => 'foo',
                'type' => 'plain-text',
                'length' => '100',
                'variations' => '',
            ]);

        $this->assertDatabaseHas('fields', [
            'name' => 'foo',
        ]);
    }

    /*
    |---------------------------------------------------------------
    | Special case for testing ajax responses
    |---------------------------------------------------------------
    */
    public function test_insert_field_noname()
    {
        $response = $this->withSession([
            'logged_in' => 1,
            'userid' => '1',
        ]);

        $requestData = [
            'name' => '',
            'instructions' => 'foo',
            'type' => 'plain-text',
            'length' => '100',
            'variations' => '',
        ];

        $response = $this->json('POST', 'admin/fields/create', $requestData);

        $response->assertStatus(200) // assert the expected status code
            ->assertJson([    // assert the expected JSON response
                'name' => ['The name field is required.'],
                // assert other expected response data
            ]);
    }
}

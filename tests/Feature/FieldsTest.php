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

    public function test_insert_a_csv()
    {
        $response = $this->withSession([
            'logged_in' => 1,
            'userid' => '1',
        ])
            ->post('admin/fields/create', [
                'name' => 'hello',
                'instructions' => 'foo',
                'type' => 'drop-down',
                'length' => '100',
                'variations' => 'a,b,c',
            ]);

        $this->assertDatabaseHas('fields', [
            'name' => 'hello',
        ]);
    }

    public function test_insert_a_malformed_csv()
    {
        $response = $this->withSession([
            'logged_in' => 1,
            'userid' => '1',
        ])
            ->post('admin/fields/create', [
                'name' => 'hellothere',
                'instructions' => 'foo',
                'type' => 'drop-down',
                'length' => '100',
                'variations' => 'a,b,,.c',
            ]);

        $this->assertDatabaseMissing('fields', [
            'name' => 'hellothere',
        ]);
    }

    public function test_duplicate_field()
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

        $requestData = [
            'name' => 'foo',
            'instructions' => 'foo',
            'type' => 'plain-text',
            'length' => '100',
            'variations' => '',
        ];

        $response = $this->json('POST', 'admin/fields/create', $requestData);

        $response->assertStatus(200) // assert the expected status code
            ->assertJson([    // assert the expected JSON response
                'name' => ['The name has already been taken.'],
                // assert other expected response data
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

    public function test_insert_field_reserved_word()
    {
        $response = $this->withSession([
            'logged_in' => 1,
            'userid' => '1',
        ]);

        $requestData = [
            'name' => 'url',
            'instructions' => 'foo',
            'type' => 'plain-text',
            'length' => '100',
            'variations' => '',
        ];

        $response = $this->json('POST', 'admin/fields/create', $requestData);

        $response->assertStatus(200) // assert the expected status code
            ->assertJson([    // assert the expected JSON response
                'name' => ['The selected name is invalid.'],
                // assert other expected response data
            ]);
    }
}

<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ApiTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    public function test_example(): void
    {
        $response = $this->get('/api/V1/desks');

        $response->assertStatus(200);
    }

    public function test_createDesk(): void
    {
        $response = $this->post('/api/V1/desks/', [
            'name' => 'testname',
        ]);

        $response->assertStatus(201);
    }

    public function test_invalidFieldDesk(): void
    {
        $response = $this->post('/api/V1/desks/', [
            'name' => '',
        ], [
            'Accept'=>'application/json'
        ]);

        $response->assertUnprocessable();
    }
}

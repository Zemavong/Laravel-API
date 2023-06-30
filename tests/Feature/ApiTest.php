<?php

namespace Tests\Feature;

use App\Models\Desk;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Symfony\Component\HttpFoundation\Response;
use Tests\TestCase;

class ApiTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    public function test_example(): void
    {
        $response = $this->get('/api/V1/desks');

        $response->assertStatus(Response::HTTP_OK);
    }

    public function test_createDesk(): void
    {
        $response = $this->post('/api/V1/desks/', [
            'name' => 'testname',
        ]);

        $response->assertStatus(Response::HTTP_CREATED);
    }

    public function test_invalidFieldDesk(): void
    {
        $response = $this->post('/api/V1/desks/', [
            'name' => '',
        ], [
            'Accept' => 'application/json'
        ]);

        $response->assertStatus(Response::HTTP_UNPROCESSABLE_ENTITY);
    }

    public function test_invalidEmptyUpdateDesk(): void
    {
        $deskId = Desk::query()->first();
        $response = $this->post('/api/V1/desks/' . $deskId['id'], [
            '_method' => 'PUT',
        ], [
            'Accept' => 'application/json'
        ]);

        $response->assertStatus(Response::HTTP_UNPROCESSABLE_ENTITY);
    }

    public function test_UpdateDesk(): void
    {
        $deskId = Desk::query()->first();
        $response = $this->post('/api/V1/desks/' . $deskId['id'], [
            '_method' => 'PUT',
            'name' => 'New'
        ], [
            'Accept' => 'application/json'
        ]);

        $response->assertStatus(Response::HTTP_OK);
    }

    public function test_deleteDesk(): void
    {
        $deskId = Desk::query()->first();
        $response = $this->post('/api/V1/desks/' . $deskId['id'],
            [
                '_method' => 'DELETE'
            ]);

        $response->assertStatus(Response::HTTP_NO_CONTENT); //пофиксить статус
    }
}

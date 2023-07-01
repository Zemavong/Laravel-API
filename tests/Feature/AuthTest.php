<?php

namespace Tests\Feature;


use App\Models\Desk;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Symfony\Component\HttpFoundation\Response;
use Tests\TestCase;

class AuthTest extends TestCase
{

    public function test_index(): void
    {
        $response = $this->get('/api/V1/user', [
            'Accept' => 'application/json'
        ]);

        $response->assertStatus(Response::HTTP_UNAUTHORIZED);
    }

    public function test_registerSuccess(): void
    {
        $newUser = Desk::query()->latest();

        $response = $this->post('/api/V1/register', [
            "name" => $newUser['name'],
            "email" => "test@gmail.com",
            "password" => "123"
        ], [
            'Accept' => 'application/json'
        ]);

        $response->assertStatus(Response::HTTP_CREATED);
    }

    public function test_loginSuccess(): void
    {
        $response = $this->post('/api/V1/login', [
            "email" => "test@gmail.com",
            "password" => "123"
        ], [
            'Accept' => 'application/json'
        ]);

        $response->assertStatus(Response::HTTP_OK);
    }

    public function test_logoutSuccess(): void
    {
        $response = $this->post('/api/V1/logout');

        $response->assertStatus(Response::HTTP_OK);
    }


    //пофиксить запрос существующей в бд почты и добавить удаление юзера
}

<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use app\Http\Controllers;


class StockApiTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    public function test_example(): void
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }

    public function test_api_register(): void {
        $response = $this->postJson('/api/register',[
            'name' => 'James',
            'email'=> 'james@gmail.com',
            'password' => 'jamesPassword',
            'password_confirmation' => 'jamesPassword',
        ]);

     $this->assertStatus(201);
     $this->assertDatabaseHas('users', [
        'email' => 'james@gmail.com'
     ]);
    }
}

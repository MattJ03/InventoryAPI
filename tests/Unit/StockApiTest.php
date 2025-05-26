<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use Tests\Feature\Hash;


class StockApiTest extends TestCase
{
    use RefreshDatabase;
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
        ]);
        
        $response->assertStatus(201);
     
     $this->assertDatabaseHas('users', [
        'email' => 'james@gmail.com',
        
     ]);
    }
}

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
        
        $response->assertStatus(200);
     
     $this->assertDatabaseHas('users', [
        'email' => 'james@gmail.com',
        
     ]);
    }

    public function test_api_stop_register(): void {
        $response = $this->postJson('/api/register', [
            'name' => 'Matt',
            'email'=> 'NotAnEmail',
            'password' => 'fiejiwuhg',
        ]);
          $response->assertStatus(422);
          $this->assertDatabaseMissing('users', [
           'email' => 'NotAnEmail',
          ]);
    }

    public function test_api_password_too_long(): void {
        $response = $this->postJson('/api/register', [
        'name' => 'Bob',
        'email' => 'Bob@gmail.com',
        'password' => 'hfhehhncehcewciwjewhvhiwhvhweiuhvrhrhvuehveuhvieuhehviehiuhvreh',
        ]);
            $response->assertStatus(422);
            $this->assertDatabaseMissing('users', [
             'email' => 'Bob@gmail.com',
            ]);
    }
}

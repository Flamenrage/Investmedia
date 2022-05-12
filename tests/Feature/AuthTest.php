<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Str;
use Tests\TestCase;
use Illuminate\Database\Eloquent\Factories\Factory;

class AuthTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_login_correct_data()
    {
        $this->postJson('/login', [
            'email' => '125@mail.com',
            'password' => '12345'
        ])->assertRedirect();

        session()->invalidate();
    }

    public function test_login_wrong_data()
    {
        $this->postJson('/login', [
            'email' => '125@mail.com',
            'password' => 'wrong_password'
        ])->assertStatus(302);
    }

    public function test_register_data()
    {
        $this->postJson('/register',[
            'name' => 'Ник Дерри',
            'email' => 'nickderry@mail.com',
            'password' => '12345',
            'password_confirmation' => '12345'
        ])->assertRedirect();
        $this->assertDatabaseHas('users', [
            'email' =>'nickderry@mail.com'
        ]);
        session()->invalidate();
    }

    public function test_register_wrong_data()
    {
        $this->post('/register',[
            'name' => 'Николай Гречкин',
            'email' => 'nick@mail.com',
            'password' => '1',
            'password_confirmation' => '5'
        ])->assertStatus(302);
        $this->assertDatabaseMissing('users', [
            'name' => Str::slug('Николай Гречкин')
        ]);
    }
}

<?php

namespace Unit;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class UserControllerTest extends TestCase
{

    use RefreshDatabase;

    /**
     * Test Register
     */
    public function test_register_should_be_validate()
    {
        $response = $this->postJson(route('auth.register'));

        $response->assertStatus(422);
    }

    public function test_new_user_can_be_register()
    {
        $response = $this->postJson(route('auth.register'),[
            'name'=>'omid',
            'email'=>'omidrayaneh@gmail.com',
            'password'=>'123456',
            'status'=>'0'
        ]);

        $response->assertStatus(201);
    }

    /**
     *Test Login
     */
    public function test_login_should_be_validate()
    {
        $response = $this->postJson(route('auth.login'));

        $response->assertStatus(422);
    }
    public function test_user_can_be_login_with_true_credentials()
    {

        $user = User::factory()->create();
        $response = $this->actingAs($user)->postJson(route('auth.login'),[
            'email'=>$user->email,
            'password'=>'password',
            'status'=>'0'
        ]);

        $response->assertStatus(200);
    }

    public function test_logged_in_user_can_logout()
    {
        $user = User::factory()->create();

        $this->be($user);

        $response = $this->actingAs($user)->postJson(route('auth.logout'));


        $response->assertStatus(200);
    }
}

<?php

namespace Tests\Unit;

// use PHPUnit\Framework\TestCase;
use Tests\TestCase;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class UserTest extends TestCase
{
    /**
     * A basic unit test example.
     *
     * @return void
     */
       public function test_user_can_register()
    {
        $user = User::factory()->raw();
        $response = $this->json('POST', '/api/register', $user);
        $response->assertStatus(201);
    }

    public function test_user_can_login()
    {
        $user = ["email"=>"onadeji9@gmail.com", "password"=>"123456789"];
        $response = $this->json('POST', '/api/login', $user);
        $response->assertStatus(200);
    }

    public function test_user_can_see_all_users()
    {
        $this->withoutExceptionHandling();
        $user = User::factory()->create();
        $response = $this->actingAs($user)->get('api/user');
        $response->assertStatus(200);
    }

    public function test_user_can_show()
    {
        $this->withoutExceptionHandling();
        $user = User::factory()->create();
        $response = $this->actingAs($user)->get('api/user/'.Auth::user()->id, ["first_name"=>"Testing"]);
        $response->assertStatus(200);
    }

    public function test_can_update_user()
    { 
        $this->withoutExceptionHandling();
        $user = User::factory()->create();
        $response = $this->actingAs($user)->put('api/user/'.Auth::user()->id, ["first_name"=>"Testing"]);
        $response->assertStatus(200);
    }

    public function test_can_delete_user()
    { 
        $this->withoutExceptionHandling();
        $user = User::factory()->create();
        $response = $this->actingAs($user)->delete('api/user/'.Auth::user()->id);
        $response->assertStatus(200);
    }
}

<?php

namespace Tests\Unit;
use Tests\TestCase;
use App\Models\User;
use App\Models\Vendor;

class VendorTest extends TestCase
{
    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function test_can_see_all_vendors()
    {
        $this->withoutExceptionHandling();
        $user = User::factory()->create();
        $response = $this->actingAs($user)->get('api/vendor');
        $response->assertStatus(200);
    }

    public function test_can_see_a_vendor()
    {
        $this->withoutExceptionHandling();
        $user = User::factory()->create();
        $vendor = Vendor::first();
        $response = $this->actingAs($user)->get('api/vendor/'.$vendor->id);
        $response->assertStatus(200);
    }
    public function test_can_create_vendor()
    {
        $this->withoutExceptionHandling();
        $user = User::factory()->create();
        $vendor = Vendor::factory()->raw();
        $response = $this->actingAs($user)->post('api/vendor', $vendor);
        $response->assertStatus(201);
    }

    public function test_can_update_vendor()
    {
        $this->withoutExceptionHandling();
        $user = User::factory()->create();
        $vendorToUpdate = Vendor::first();
        $vendor = ["name"=>"Edited Name"];
        $response = $this->actingAs($user)->put('api/vendor/'.$vendorToUpdate->id, $vendor);
        $response->assertStatus(200);
    }

    public function test_can_delete_vendor()
    {
        $this->withoutExceptionHandling();
        $user = User::factory()->create();
        $vendor = Vendor::first();
        $response = $this->actingAs($user)->delete('api/vendor/'.$vendor->id);
        $response->assertStatus(200);
    }


}

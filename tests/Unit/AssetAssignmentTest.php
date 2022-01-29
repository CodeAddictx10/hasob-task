<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Models\User;
use App\Models\AssetAssignment;

class AssetAssignmentTest extends TestCase
{
    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function test_can_show_all_assigned_assets()
    {
        $this->withoutExceptionHandling();
        $user = User::factory()->create();
        $response = $this->actingAs($user)->get('api/asset');
        $response->assertStatus(200);
    }

    public function test_can_show_an_assigned_asset()
    {
        $this->withoutExceptionHandling();
        $user = User::factory()->create();
        $assigned = AssetAssignment::first();
        $response = $this->actingAs($user)->get('api/asset/'.$assigned->id);
        $response->assertStatus(200);
    }

    public function test_can_assign_an_asset()
    {
        $this->withoutExceptionHandling();
        $user = User::factory()->create();
        $assignment = AssetAssignment::factory()->raw();
        $response = $this->actingAs($user)->post('api/asset', $assignment);
        $response->assertStatus(201);
    }

    public function test_can_update_an_assigned_asset()
    {
        $this->withoutExceptionHandling();
        $user = User::factory()->create();
        $assignment = AssetAssignment::first();
        $newUpdate = ["is_due"=> true, "status"=>true];
        $response = $this->actingAs($user)->put('api/asset/'.$assignment->id, $newUpdate);
        $response->assertStatus(200);
    }
    public function test_can_delete_an_assigned_asset()
    {
        $this->withoutExceptionHandling();
        $user = User::factory()->create();
        $assignment = AssetAssignment::first();
        $response = $this->actingAs($user)->delete('api/asset/'.$assignment->id);
        $response->assertStatus(200);
    }
}

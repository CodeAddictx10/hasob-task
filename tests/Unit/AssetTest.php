<?php

namespace Tests\Unit;

use App\Models\Asset;
use App\Models\User;
use Tests\TestCase;
class AssetTest extends TestCase
{
    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function test_can_show_all_assets()
    {
        $this->withoutExceptionHandling();
        $user = User::factory()->create();
        $response = $this->actingAs($user)->get('api/asset');
        $response->assertStatus(200);
    }

    public function test_can_show_an_asset()
    {
        $this->withoutExceptionHandling();
        $user = User::factory()->create();
        $response = $this->actingAs($user)->get('api/asset/1');
        $response->assertStatus(200);
    }

    public function test_can_create_asset()
    {
        $this->withoutExceptionHandling();
        $user = User::factory()->create();
        $asset = Asset::factory()->raw();
        $response = $this->actingAs($user)->post('api/asset', $asset);
        $response->assertStatus(201);
    }

    public function test_can_update_asset()
    {
        $this->withoutExceptionHandling();
        $user = User::factory()->create();
        $toUpdate = ["type"=>"Update type", "degradation_in_years"=>10];
        $response = $this->actingAs($user)->put('api/asset/4', $toUpdate);
        $response->assertStatus(200);
    }

    public function test_can_delete_asset()
    {
        $this->withoutExceptionHandling();
        $user = User::factory()->create();
        $response = $this->actingAs($user)->delete('api/asset/4');
        $response->assertStatus(200);
    }
}

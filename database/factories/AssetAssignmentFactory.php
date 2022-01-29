<?php

namespace Database\Factories;

use App\Models\Asset;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Factories\Factory;

class AssetAssignmentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            "asset_id"=> Asset::first()->id,
            "assignment_date"=> $this->faker->date('Y-m-d'),
            "status"=> true,
            "is_due"=> false,
            "due_date"=> $this->faker->date('Y-m-d'),
            "assigned_user_id"=>Auth::user()->id
        ];
    }
}

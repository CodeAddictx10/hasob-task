<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class AssetFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            //
                "type"=> $this->faker->word(),
                "serial_no"=>$this->faker->uuid3(),
                "description"=> $this->faker->text(),
                "fixed_or_movable"=> "Fixed",
                "picture_path"=>  $this->faker->url(),
                "purchase_date"=> $this->faker->date('Y-m-d'),
                "start_to_use_date"=> $this->faker->date('Y-m-d'),
                "purchase_price"=> $this->faker->randomNumber(),
                "warranty_expiry_date"=> $this->faker->date('Y-m-d'),
                "degradation_in_years"=>$this->faker->randomDigit(),
                "current_value_in_naira"=> $this->faker->randomNumber(),
                "location"=> $this->faker->address()
            
        ];
    }
}

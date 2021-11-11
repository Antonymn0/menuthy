<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class RestaurantFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'restaurant_name' => $this->faker->word(),
            'restaurant_type' => $this->faker->word(),
            'user_id' => 1,
            'country' => $this->faker->word(),
            'county' => $this->faker->word(),
            'city' => $this->faker->word(),
            'address' => $this->faker->address(),
            'restaurant_phone_number' => $this->faker->phoneNumber(),
            'restaurant_email' => $this->faker->safeEmail(),
            'is24/7' => $this->faker->randomDigit(),
            'opening_hrs' => now(),
            'closing_hrs' => now(),
            'offer_accomodation' => $this->faker-> randomDigit(),
            'slang' => $this->faker->sentence,
            'description' => $this->faker->paragraph(),
            'avatar' => $this->faker->url(),
            // 'deleted_at' => null 
        ];
    }
}

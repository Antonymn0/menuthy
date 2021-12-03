<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class UserFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
        'full_name' => $this->faker->sentence,
        'first_name'=> $this->faker->word(),
        'middle_name'=> $this->faker->word(),
        'last_name'=> $this->faker->word(),
        'user_name'=> now() . $this->faker->unique()->userName(),
        'email' =>  $this->faker->unique()->safeEmail()  ,
        'phone'=> now() . $this->faker->phoneNumber(),
        'address'=> $this->faker->address(),
        'biography'=> $this->faker->sentence(),
        'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
        'dob'=> $this->faker->date(),
        'county'=> $this->faker->word(),
        'city'=> $this->faker->country(),
        'location'=> $this->faker->word(),
        'suspended_at'=> now(),
        'suspended_by'=> $this->faker-> randomDigit(),
        'email_verified_at' => now(),
        'gender'=> $this->faker-> randomDigit(),
        'registration_status'=> $this->faker-> randomDigit(),
        'suspended_by'=> $this->faker->randomDigit(),
        'avatar'=> $this->faker->url(),
        'deleted_at'=> null,

        'name' => $this->faker->name(),          
            
        'remember_token' => Str::random(10),
        ];
    }

    /**
     * Indicate that the model's email address should be unverified.
     *
     * @return \Illuminate\Database\Eloquent\Factories\Factory
     */
    public function unverified()
    {
        return $this->state(function (array $attributes) {
            return [
                'email_verified_at' => null,
            ];
        });
    }
}

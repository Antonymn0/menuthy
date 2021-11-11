<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class QrCodeFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'table_number' => $this->faker->randomDigit(),
            'table_id' => $this->faker->randomDigit(),
            'qr_code_img' => $this->faker->url(),
            'qr_code_target_link' => $this->faker->url(),
            'avatar' => $this->faker->url(),
            // 'deleted_at' => null
        ];
    }
}

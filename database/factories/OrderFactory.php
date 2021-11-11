<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class OrderFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'menu_item_name' => $this->faker->word(),
            'menu_item_type' => $this->faker->word(),
            'menu_item_id' => $this->faker->randomdigit(),
            'is_take_away' => $this->faker->randomdigit(),
            'is_inhouse' => $this->faker->randomdigit(),
            'price' => $this->faker->randomFloat(1,0),
            'preperation_time' => $this->faker->word(),
            'state' => $this->faker->word(),
            'accompaniments' => $this->faker->sentence(),
            'avatar' => $this->faker->url() ,
            // 'deleted_at' => '',
        ];
    }
}

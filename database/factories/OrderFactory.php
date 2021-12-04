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
            'menu_item_name' => $this->faker->randomElement(['chicken wings', 'rice and lamb stew', 'beef curry', 'roast potatoes']),
            'menu_item_type' => $this->faker->word(),
            'menu_item_id' => $this->faker->randomdigit(), //foreign key
            'is_take_away' => $this->faker->randomdigit(),
            'order_number' => 2568,
            'table_number' => 25,
            'is_inhouse' => $this->faker->randomdigit(),
            'price' => $this->faker->randomFloat(1,0),
            'restaurant_id' => $this->faker->randomFloat(1,0),
            'preparation_time' =>5,
            'status' => $this->faker->randomElement(['recieved', 'processing', 'complete','canceled']),
            'order_for' => $this->faker->randomElement([1, 2, 3,4]),
            'order_type' => $this->faker->randomElement(['dine in', 'take away', 'pick up']),
            'accompaniments' => $this->faker->sentence(),
            'avatar' => $this->faker->url() ,
            // 'deleted_at' => '',
        ];
    }
}

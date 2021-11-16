<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class MenuItemFactory extends Factory
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
            'availability' => $this->faker->word(),
            'take_away' => $this->faker->randomDigit(1.2),
            'sub_menu_id' => $this->faker->randomDigit(1,2),
            'inhouse' => $this->faker->randomDigit(1,2),
            'price' => $this->faker->randomFloat(1,2),
            'preparation_time' => $this->faker->randomElement([20, 30, 10 ,5]),
            'available_days' => $this->faker->word(),
            'slang' => $this->faker->word(),
            'description' => $this->faker->sentence(),
            'discount' => $this->faker->randomFloat(1,2),
            'image' => $this->faker->url(),
            'avatar' => $this->faker->word(),
            // 'deleted_at' => null
        ];
    }
}

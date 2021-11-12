<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class MenuFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'menu_name' => $this->faker->randomElement(['main', 'drinks', 'daily specials','Desserts', 'Breakfast','lunch']),
            'category' => $this->faker->randomElement(['food', 'drinks', 'appetizer']),
            'restaurant_id' => 1,
            'availability' => $this->faker->word(),
            'take_away' => $this->faker->randomDigit(),
            'in_house' => $this->faker->randomDigit(),
            'available_days' => $this->faker->sentence(),
            'slang' => $this->faker->sentence(),
            'description' => $this->faker->paragraph(),
            'avatar' => $this->faker->url(),
            // 'deleted_at' => null,
        ];
    }
}

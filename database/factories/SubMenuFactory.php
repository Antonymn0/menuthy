<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class SubMenuFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'sub_menu_name' => $this->faker-> randomElement(['half breakfast', 'full breakfast', 'half lunch']),
            'sub_menu_type' => $this->faker-> randomElement(['food', 'beverages', 'drinks']),
            'menu_id' => 1,
            'restaurant_id' => 1,
            'availability' => $this->faker-> randomElement(['morning', 'afternoon', 'allday']),
            'take_away' => $this->faker-> numberBetween(1,2),
            'inhouse' => $this->faker-> numberBetween(1,2),
            'available_days' => $this->faker-> randomElement(['monday', 'wednesday', 'friday']),
            'slang' => $this->faker-> word(),
            'description' => $this->faker-> sentence(),
            'image' => $this->faker-> url(),
            'avatar' => $this->faker-> url(),
            'deleted_at' => null
        ];
    }
}

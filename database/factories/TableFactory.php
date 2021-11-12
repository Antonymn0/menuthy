<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class TableFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'table_number' => $this->faker-> randomDigit(),
            'table_name' => $this->faker-> word(),
            'qr_code_link' => $this->faker-> url(),
            'avatar' => $this->faker-> url(),
            'deleted_at' => null,
            ];
    }
}

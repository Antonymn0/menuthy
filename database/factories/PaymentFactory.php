<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class PaymentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'order_id' => 1,
            'amount_due' => $this->faker->randomFloat(2,0,2),
            'amount_paid' => $this->faker->randomFloat(2,0,2),
            'discount_amount' => $this->faker->randomFloat(2,0,2),
            'status' => $this->faker->randomElement(['paid', 'pending']),
            'payment_method' => $this->faker->randomElement(['paypal', 'mobileMoney', 'stripe']),
            'transaction_id' => $this->faker->regexify('[A-Za-z0-9]{20}'),
            'customer_name' => $this->faker->firstName() .' ' . $this->faker->lastName(),
            'transaction_date' => now(),
            'table_number' => $this->faker->randomDigit(),
            'payee_account_number' => $this->faker->randomElement(['23-365566', '569-996333','5669-985','email@email.com']),
            'avatar' => $this->faker->url()
            // 'deleted_at' => null
        ];
    }
}

<?php

namespace Database\Factories;


use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Order;

class OrderFactory extends Factory
{
    
    protected $model = Order::class;

    public function definition()
    {
        return [
            'user_id' => $this->faker->numberBetween(1, 10),
            'customer_contact' => $this->faker->phoneNumber,
            'total_price' => $this->faker->randomFloat(2, 1, 500),

        ];
    }
}

<?php

namespace Database\Factories;
use App\Models\Cart;

use Illuminate\Database\Eloquent\Factories\Factory;


class CartFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
     protected $model = Cart::class;

    public function definition()
    {
        return [
            'user_id' => $this->faker->numberBetween(1, 10),
            'product_id' => $this->faker->numberBetween(1, 50),
            'quantity' => $this->faker->numberBetween(1, 5),
        ];
    }
}

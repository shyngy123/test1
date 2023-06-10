<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

use App\Models\Category;

class CategoryFactory extends Factory
{
    
    protected $model = Category::class;

    public function definition()
    {
        return [
            'name' => $this->faker->word,
            'parent_id' => $this->faker->numberBetween(1, 10),
        ];
    }
}

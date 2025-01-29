<?php

namespace Database\Factories;

use App\Models\Category;
use App\Models\Property;
use Illuminate\Database\Eloquent\Factories\Factory;

class PropertyFactory extends Factory
{
    public function definition(): array
    {
        return [
            'value' => fake()->word(),
            'category_id' => Category::factory(),
        ];
    }
}
